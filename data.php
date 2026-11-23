<?php
require_once "koneksi.php";

$sql = "SELECT * FROM anggota order by id desc";
$hasil = mysqli_query($koneksi, $sql);
echo "<br><br>";

$jumlah = mysqli_num_rows($hasil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    th, td {
      padding: 10px;
    }
    th {
      background-color: lightskyblue;
    }
    .aksi{
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
  </style>
</head>
<body>
  <table border="1" cellspacing="0">
    <tr>
      <th>Id</th>
      <th>No Anggota</th>
      <th>Nama Lengkap</th>
      <th>Email</th>
      <th>No Handphone</th>
      <th>Jenis Anggota</th>
      <th>Alamat</th>
      <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($baris = mysqli_fetch_assoc($hasil)) { ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo htmlspecialchars($baris["no_anggota"]); ?></td>
      <td><?php echo htmlspecialchars($baris["nama_lengkap"]); ?></td>
      <td><?php echo htmlspecialchars($baris["email"]); ?></td>
      <td><?php echo htmlspecialchars($baris["no_hp"]); ?></td>
      <td><?php echo htmlspecialchars($baris["jenis_anggota"]); ?></td>
      <td><?php echo htmlspecialchars($baris["alamat"]); ?></td>
      <td class="aksi">
        <a href="detail.php" >Detail</a>
        <form action="" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
          <input type="hidden" name="id" value="">
          <button type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>