<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $phone_number = $_POST['phone_number'];

    // Prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("UPDATE participants SET name=?, birth_date=?, phone_number=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $birth_date, $phone_number, $id);

    if ($stmt->execute()) {
        echo "<p>Record updated successfully</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Pastikan ID valid dan ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepared statement untuk mengambil data peserta
    $stmt = $conn->prepare("SELECT * FROM participants WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $participant = $result->fetch_assoc();
    } else {
        echo "<p>Participant not found.</p>";
        exit();
    }
    
    $stmt->close();
} else {
    echo "<p>ID not provided.</p>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Participant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        input[type="text"],
        input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding in width calculation */
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Data Peserta</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($participant['id']); ?>">
            Nama: <input type="text" name="name" value="<?php echo htmlspecialchars($participant['name']); ?>" required><br>
            Tanggal Lahir: <input type="date" name="birth_date" value="<?php echo htmlspecialchars($participant['birth_date']); ?>" required><br>
            Nomor Hp: <input type="text" name="phone_number" value="<?php echo htmlspecialchars($participant['phone_number']); ?>" required><br>
            <input type="submit" value="Upload">
        </form>
    </div>
</body>
</html>
