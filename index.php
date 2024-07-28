<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$sql = "SELECT id, name, birth_date, phone_number FROM participants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Lomba Solo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 900px; 
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin: 0 0 20px;
        }
        a {
            text-decoration: none;
            color: #007bff;
            display: inline-block;
            margin-bottom: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Peserta Lomba Solo</h2>
        <a href="create.php">Tambah Peserta</a> | <a href="logout.php">Logout</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Nomor Hp</th>
                <th>Aksi</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td>" . htmlspecialchars($row["birth_date"]) . "</td>
                            <td>" . htmlspecialchars($row["phone_number"]) . "</td>
                            <td class='actions'>
                                <a href='update.php?id=" . $row["id"] . "'>Edit</a> |
                                <a href='delete.php?id=" . $row["id"] . "'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada peserta yang ditemukan</td></tr>";
            }
            ?>
        </table>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
