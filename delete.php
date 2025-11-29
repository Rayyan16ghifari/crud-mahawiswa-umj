<?php
require "db.php";
require "CrudInterface.php";
require "Utils/Logger.php";
require "MahasiswaModel.php";

use App\MahasiswaModel;

// Buat object model
$mhs = new MahasiswaModel($conn);

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: mahasiswa.php");
    exit;
}

$id = intval($_GET['id']);

// Eksekusi delete
$mhs->delete($id);

// Redirect kembali ke halaman utama
header("Location: mahasiswa.php");
exit;
?>
