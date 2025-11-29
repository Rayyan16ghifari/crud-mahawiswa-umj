<?php
require "db.php";               // koneksi
require "CrudInterface.php";    // interface CRUD (namespace App)
require "Utils/Logger.php";     // logger (namespace App\Utils)
require "MahasiswaModel.php";   // model utama

use App\MahasiswaModel;

$mhs = new MahasiswaModel($conn);

// pastikan id ada dan numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id   = intval($_GET['id']);
$data = $mhs->getById($id);

if (!$data) {
    // kalau id tidak ditemukan
    header("Location: mahasiswa.php");
    exit;
}

if (isset($_POST['update'])) {
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $tahun = $_POST['tahun'];

    $mhs->update($id, $nim, $nama, $tahun);
    header("Location: mahasiswa.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background:#0d1117;
            color:white;
            font-family:'Poppins',sans-serif;
            opacity:0;
            transition:opacity .4s ease;
        }
        body.fade-in { opacity:1; }

        .glass-card {
            background:rgba(255,255,255,0.07);
            padding:25px;
            border-radius:15px;
            border:1px solid rgba(255,255,255,0.15);
            margin-top:40px;
            box-shadow:0 0 18px rgba(0,255,255,0.06);
        }

        .title {
            font-size:24px;
            font-weight:600;
            color:#00eaff;
            margin-bottom:18px;
            text-shadow:0 0 10px rgba(0,255,255,0.4);
        }

        .btn-custom {
            background:#00eaff;
            color:#000;
            font-weight:600;
            padding:10px 20px;
            border-radius:8px;
            border:none;
            transition:.25s;
        }
        .btn-custom:hover {
            box-shadow:0 0 12px #00eaff;
            background:#00ffff;
            transform:translateY(-2px);
        }
    </style>
</head>
<body>

<?php include "navbar.php"; ?>

<div class="container">
    <div class="glass-card">
        <div class="title">
            <i class="bi bi-pencil-square"></i> Edit Data Mahasiswa
        </div>

        <form method="POST">
            <input type="text" name="nim"   class="form-control mb-3" value="<?= htmlspecialchars($data['nim']); ?>" required>
            <input type="text" name="nama"  class="form-control mb-3" value="<?= htmlspecialchars($data['nama']); ?>" required>
            <input type="number" name="tahun" class="form-control mb-3" value="<?= htmlspecialchars($data['tahun_angkatan']); ?>" required>

            <button class="btn btn-custom" name="update">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add("fade-in");
});
</script>
</body>
</html>
