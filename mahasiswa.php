<?php
require "db.php";
require "CrudInterface.php";
require "Utils/Logger.php";
require "MahasiswaModel.php";

use App\MahasiswaModel;

$mhs = new MahasiswaModel($conn);

// CREATE
if (isset($_POST['save'])) {
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $tahun = $_POST['tahun'];

    $mhs->create($nim, $nama, $tahun);
    header("Location: mahasiswa.php");
    exit;
}

// AMBIL DATA
$result = $mhs->getAll();

// MASUKKAN KE ARRAY (syarat array + loop)
$listMahasiswa = [];
while ($row = mysqli_fetch_assoc($result)) {
    $listMahasiswa[] = $row;
}

// HITUNG STATISTIK (pakai array & loop & if)
$totalMahasiswa   = count($listMahasiswa);
$angkatanCounts   = [];

foreach ($listMahasiswa as $m) {
    $angkatan = $m['tahun_angkatan'];

    if (!isset($angkatanCounts[$angkatan])) {
        $angkatanCounts[$angkatan] = 0;
    }
    $angkatanCounts[$angkatan]++;
}

$currentYear = (int)date('Y');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        background:#0d1117;
        font-family:'Poppins',sans-serif;
        color:white;

        opacity: 0;
        transition: opacity 0.5s ease;
    }
    body.fade-in { opacity: 1; }

    .glass-card {
        background:rgba(255,255,255,0.07);
        padding:25px;
        border-radius:15px;
        margin-bottom:25px;
        border:1px solid rgba(255,255,255,0.15);
        backdrop-filter:blur(12px);
        box-shadow: 0 0 15px rgba(0,255,255,0.05);
    }
    .title {
        font-size:26px;
        font-weight:600;
        color:#00eaff;
        margin-bottom:15px;
        text-shadow:0 0 10px rgba(0,255,255,0.3);
    }
    .btn-custom {
        background:#00eaff;
        color:black;
        font-weight:600;
        border-radius:8px;
        transition:0.3s;
    }
    .btn-custom:hover {
        box-shadow:0 0 15px #00eaff;
        transform: translateY(-2px);
    }
    .table-dark {
        background: rgba(0,0,0,0.3) !important;
    }
    th {
        color:#00eaff !important;
        font-weight:600;
        text-shadow:0 0 8px rgba(0,255,255,0.4);
    }
    td {
        color:white !important;
    }
    .summary-box {
        font-size:14px;
        color:#ccc;
    }
</style>

</head>
<body>

<?php include("navbar.php"); ?>

<div class="container">

    <!-- RINGKASAN (pakai array & loop) -->
    <div class="glass-card summary-box">
        <div class="title"><i class="bi bi-graph-up"></i> Ringkasan Data</div>
        <p>Total Mahasiswa: <strong><?= $totalMahasiswa; ?></strong></p>
        <p>Per Angkatan:</p>
        <ul>
            <?php foreach ($angkatanCounts as $tahun => $jumlah): ?>
                <li>Angkatan <?= $tahun; ?> : <?= $jumlah; ?> orang</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- FORM TAMBAH -->
    <div class="glass-card">
        <div class="title"><i class="bi bi-person-plus"></i> Tambah Mahasiswa</div>

        <form method="POST">
            <input type="text" name="nim" class="form-control mb-3" required placeholder="NIM">
            <input type="text" name="nama" class="form-control mb-3" required placeholder="Nama">
            <input type="number" name="tahun" class="form-control mb-3" required placeholder="Tahun Angkatan">
            <button class="btn btn-custom" name="save">
                <i class="bi bi-plus-lg"></i> Tambah
            </button>
        </form>
    </div>

    <!-- DAFTAR MAHASISWA -->
    <div class="glass-card">
        <div class="title"><i class="bi bi-people"></i> Daftar Mahasiswa</div>

        <table class="table table-dark table-bordered table-hover">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Status</th> <!-- pakai switch -->
                <th>Aksi</th>
            </tr>

            <?php foreach ($listMahasiswa as $row): ?>
            <?php
                $selisih = $currentYear - (int)$row['tahun_angkatan'];
                // switch dipakai buat status (syarat struktur kontrol)
                switch (true) {
                    case ($selisih <= 0):
                        $status = "Mahasiswa Baru";
                        break;
                    case ($selisih <= 3):
                        $status = "Mahasiswa Aktif";
                        break;
                    default:
                        $status = "Senior";
                        break;
                }
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['nim']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tahun_angkatan']; ?></td>
                <td><?= $status; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#"
                       onclick="return hapusData(<?= $row['id']; ?>)"
                       class="btn btn-danger btn-sm no-fade">
                       <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>

</div>

<!-- Fade-in saat halaman load -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add("fade-in");
});
</script>

<!-- Fungsi hapus dengan konfirmasi yang benar -->
<script>
function hapusData(id) {
    const yakin = confirm('Yakin ingin menghapus data ini?');
    if (yakin) {
        window.location.href = 'delete.php?id=' + id;
        return true;
    }
    return false;
}
</script>

<!-- Fade-out transisi untuk link, kecuali yang pakai .no-fade (tombol hapus) -->
<script>
document.querySelectorAll("a:not(.no-fade)").forEach(link => {
    link.addEventListener("click", e => {
        const target = link.getAttribute("href");
        if (target && !target.startsWith("#") && !target.startsWith("javascript")) {
            e.preventDefault();
            document.body.style.opacity = 0;
            setTimeout(() => window.location.href = target, 300);
        }
    });
});
</script>

<?php include("footer.php"); ?>

<script>
// Perbaikan BACK button agar tidak blank
window.addEventListener("pageshow", function(event) {
    if (event.persisted) {
        document.body.style.opacity = 1;
    }
});
</script>

</body>
</html>
