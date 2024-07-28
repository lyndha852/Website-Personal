<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $phone_number = $_POST['phone_number'];

    $name = $conn->real_escape_string($name);
    $birth_date = $conn->real_escape_string($birth_date);
    $phone_number = $conn->real_escape_string($phone_number);

    $sql = "INSERT INTO participants (name, birth_date, phone_number) VALUES ('$name', '$birth_date', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "New participant added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Peserta</h2>
        <form method="post" action="">
            Nama: <input type="text" name="name" required><br>
            Tanggal Lahir: <input type="date" name="birth_date" required><br>
            No Hp: <input type="text" name="phone_number" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
