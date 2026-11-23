<?php

require_once "koneksi.php";

$versi_server = mysqli_get_server_info($koneksi);

mysqli_close($koneksi);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Koneksi Database</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        p {
            background-color: lightgreen;
            padding: 8px;
            border-left: 4px solid green;
        }
    </style>
</head>
<body>

    <h1>Tes Koneksi Database</h1>

    <p>Koneksi ke MySQL berhasil.</p>

    <table>
        <tr>
            <td>Host</td>
            <td>: <?php echo htmlspecialchars($host); ?></td>
        </tr>

        <tr>
            <td>Database</td>
            <td>: <?php echo htmlspecialchars($database); ?></td>
        </tr>

        <tr>
            <td>Versi Server</td>
            <td>: <?php echo htmlspecialchars($versi_server); ?></td>
        </tr>
    </table>

</body>
</html>
