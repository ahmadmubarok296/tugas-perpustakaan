<?php
require_once "koneksi.php";

$id = $_GET['id'];

$sql = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
    th,
    td {
      text-align: left;
      padding-right: 15px;
    }
    .kotak {
      border: 2px solid black;
      width: fit-content;
      padding: 12px;
      margin-left: 10px;
      border-radius: 10px;
    }
    a {
      margin-left: 12px;
    }
  </style>
</head>

<body>
  <h2>Detail Anggota Perpustakaan</h2>
  <div class="kotak">
    <table>
      <tr>
        <th ">No Anggota</th>
        <th>:</th>
        <td><?php echo $data['no_anggota'] ?></td>
      </tr>
      <tr>
        <th>Nama Lengkap</th>
        <th>:</th>
        <td><?php echo $data['nama_lengkap'] ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <th>:</th>
        <td><?php echo $data['email'] ?></td>
      </tr>
      <tr>
        <th>No Handphone</th>
        <th>:</th>
        <td><?php echo $data['no_hp'] ?></td>
      </tr>
      <tr>
        <th>Jenis Anggota</th>
        <th>:</th>
        <td><?php echo $data['jenis_anggota'] ?></td>
      </tr>
      <tr>
        <th>Alamat</th>
        <th>:</th>
        <td><?php echo $data['alamat'] ?></td>
      </tr>
    </table>
  </div><br>
  <a href="data.php">Kembali</a>
</body>
</html>