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
    .link {
      color: black;
      text-decoration: none;
      background-color: lightgray;
      padding-bottom: 2px;
      padding-top: 2px;
      padding-left: 10px;
      padding-right: 10px;
      border-radius: 5px;
      border: 1px solid lightslategray;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .link:hover {
      background-color: grey;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <h1>Data Anggota Perpustakaan</h1>
  <a href="form_anggota.php">Kembali ke formulir</a><br><br>
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
      <td><?php echo htmlspecialchars($baris['no_anggota']); ?></td>
      <td><?php echo htmlspecialchars($baris['nama_lengkap']); ?></td>
      <td><?php echo htmlspecialchars($baris['email']); ?></td>
      <td><?php echo htmlspecialchars($baris['no_hp']); ?></td>
      <td><?php echo htmlspecialchars($baris['jenis_anggota']); ?></td>
      <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
      <td class="aksi">
        <a class="link" href="detail.php?id=<?php echo $baris['id']; ?>" >Detail</a>
        <a class="link" href="edit.php?id=<?php echo $baris['id']; ?>">Edit</a>
        <form action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
          <input type="hidden" name="id" value="<?php echo $baris['id']; ?>">
          <button type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>