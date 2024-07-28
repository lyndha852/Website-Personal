<?php
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
            padding-top: 20px; 
        }
        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center; 
            padding: 0 20px; 
        }
        table {
            border-collapse: collapse;
            width: 100%; 
            max-width: 100%; 
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            margin: 0;
            padding: 0 0 10px 0;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Peserta Lomba Solo</h2>
        <a href="create.php">Tambah Peserta</a>
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
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["birth_date"] . "</td>
                            <td>" . $row["phone_number"] . "</td>
                            <td>
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
