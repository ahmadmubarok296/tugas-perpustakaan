<?php
require_once "koneksi.php";

$errors = [];

// Mengambil data dari form
$no_anggota = isset($_POST["no_anggota"]) ? trim($_POST["no_anggota"]) : "";
$nama_lengkap = isset($_POST["nama_lengkap"]) ? trim($_POST["nama_lengkap"]) : "";
$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$no_hp = isset($_POST["no_hp"]) ? trim($_POST["no_hp"]) : "";
$jenis_anggota = isset($_POST["jenis_anggota"]) ? trim($_POST["jenis_anggota"]) : "";
$alamat = isset($_POST["alamat"]) ? trim($_POST["alamat"]) : "";

// Daftar jenis anggota yang diperbolehkan
$daftar_anggota = ["Mahasiswa", "Dosen", "Tenaga Kependidikan"];

// Validasi nomor anggota
if (empty($no_anggota)) {
    $errors[] = "Nomor anggota tidak boleh kosong.";
} elseif (!ctype_digit($no_anggota)) {
    $errors[] = "Nomor anggota hanya boleh berisi angka.";
} elseif (strlen($no_anggota) > 15) {
    $errors[] = "Nomor anggota maksimal 15 digit.";
}

// Validasi nama lengkap
if (empty($nama_lengkap)) {
    $errors[] = "Nama lengkap tidak boleh kosong.";
} elseif (strlen($nama_lengkap) > 100) {
    $errors[] = "Nama lengkap maksimal 100 karakter.";
}

// Validasi email
if (empty($email)) {
    $errors[] = "Email tidak boleh kosong.";
} elseif (strlen($email) > 100) {
    $errors[] = "Email maksimal 100 karakter.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format email tidak valid.";
}

// Validasi nomor HP
if (empty($no_hp)) {
    $errors[] = "Nomor HP tidak boleh kosong.";
} elseif (!ctype_digit($no_hp)) {
    $errors[] = "Nomor HP hanya boleh berisi angka.";
} elseif (strlen($no_hp) < 10 || strlen($no_hp) > 13) {
    $errors[] = "Nomor HP harus terdiri dari 10 sampai 13 digit.";
}

// Validasi jenis anggota
if (empty($jenis_anggota)) {
    $errors[] = "Jenis anggota wajib dipilih.";
} elseif (!in_array($jenis_anggota, $daftar_anggota, true)) {
    $errors[] = "Jenis anggota tidak valid.";
}

// Validasi alamat
if (empty($alamat)) {
    $errors[] = "Alamat tidak boleh kosong.";
}

// Variabel untuk menyimpan pesan database
$berhasil = false;
$pesan_db = "";

// Jika tidak ada kesalahan validasi
if (empty($errors)) {

    $sql = "INSERT INTO anggota
            (no_anggota, nama_lengkap, email, no_hp, jenis_anggota, alamat)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $no_anggota,
            $nama_lengkap,
            $email,
            $no_hp,
            $jenis_anggota,
            $alamat
        );

        if (mysqli_stmt_execute($stmt)) {
            $berhasil = true;
        } else {
            $pesan_db = mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);

    } else {
        $pesan_db = mysqli_error($koneksi);
    }
}

// Menutup koneksi database
mysqli_close($koneksi);

// Jika data berhasil disimpan
if ($berhasil) {
    header("Location: form_anggota.php?status=sukses");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tidak Valid</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            color: #c0392b;
        }

        .error-box {
            background: #fde8e8;
            border-left: 5px solid #c0392b;
            padding: 15px;
            width: 400px;
            margin-bottom: 20px;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background: #1f3864;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <h1>Data Gagal Disimpan</h1>

    <?php if (!empty($errors)) { ?>

        <div class="error-box">

            <p><strong>Data belum dapat disimpan. Perbaiki kesalahan:</strong></p>

            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php } ?>
            </ul>

        </div>

    <?php } elseif (!empty($pesan_db)) { ?>

        <div class="error-box">

            <p><strong>Terjadi kesalahan saat menyimpan data.</strong></p>

            <p>
                Penyebab:
                <?php echo htmlspecialchars($pesan_db); ?>
            </p>

        </div>

    <?php } ?>

    <a href="form_anggota.php">Kembali dan perbaiki data</a>

</body>
</html>
