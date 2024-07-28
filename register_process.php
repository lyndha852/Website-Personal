<?php
include 'config.php'; 

// Check if form data is set
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare statement to check if username already exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Username doesn't exist, insert new user
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            echo "Error during registration: " . htmlspecialchars($stmt->error);
        }
    } else {
        // Redirect to registration page with an error
        header('Location: register.php?error=true');
        exit();
    }

    $stmt->close();
} else {
    echo "Username and password are required.";
}

$conn->close();
?>
