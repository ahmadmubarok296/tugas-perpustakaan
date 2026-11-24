<?php
require_once "koneksi.php";

$id = $_GET['id'];
$sql = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }

    h1 {
      color: #1f3864;
    }

    label {
      display: block;
      margin-top: 12px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    select,
    textarea {
      width: 320px;
      padding: 6px;
    }

    button {
      margin-top: 16px;
      padding: 8px 20px;
    }
  </style>
</head>

<body>
  <h2>Edit Anggota</h2>
  <form action="proses_update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

    <label for="no_anggota">Nomor Anggota</label>
    <input type="text" id="no_anggota"
      name="no_anggota" maxlength="15" value="<?php echo htmlspecialchars($data['no_anggota']); ?>">

    <label for="nama_lengkap">Nama Lengkap</label>
    <input type="text" id="nama_lengkap"
      name="nama_lengkap" maxlength="100" value="<?php echo htmlspecialchars($data['nama_lengkap']); ?>">

    <label for="email">Email</label>
    <input type="email" id="email"
      name="email" maxlength="100" value="<?php echo htmlspecialchars($data['email']); ?>">

    <label for="no_hp">Nomor HP</label>
    <input type="text" id="no_hp"
      name="no_hp" maxlength="13" value="<?php echo htmlspecialchars($data['no_hp']); ?>">

    <label for="jenis_anggota">Jenis Anggota</label>
    <select id="jenis_anggota" name="jenis_anggota">
      <option value="">-- Pilih Jenis Anggota --</option>
      <option value="Mahasiswa" <?php echo $data['jenis_anggota'] == "Mahasiswa" ? "selected" : "" ?>>Mahasiswa</option>
      <option value="Dosen" <?php echo $data['jenis_anggota'] == "Dosen" ? "selected" : "" ?>>Dosen</option>
      <option value="Tenaga Kependidikan" <?php echo $data['jenis_anggota'] == "Tenaga Kependidikan" ? "selected" : "" ?>>Tenaga Kependidikan</option>
    </select>

    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" rows="4"><?php echo htmlspecialchars($data['alamat']); ?></textarea><br>

    <button type="submit">Ubah Data</button>
    <a href="data.php">Kembali</a>

  </form>
</body>

</html>