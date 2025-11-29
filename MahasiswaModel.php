<?php
namespace App;

use App\Utils\Logger;

class BaseModel
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}

class MahasiswaModel extends BaseModel implements CrudInterface
{
    /**
     * Ambil semua data mahasiswa
     */
    public function getAll()
    {
        $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
        return mysqli_query($this->conn, $sql);
    }

    /**
     * Ambil data mahasiswa berdasarkan ID
     */
    public function getById($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM mahasiswa WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Tambah data mahasiswa
     */
    public function create($nim, $nama, $tahun)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO mahasiswa (nim, nama, tahun_angkatan)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param("ssi", $nim, $nama, $tahun);

        $success = $stmt->execute();

        if ($success) {
            Logger::log('CREATE_MAHASISWA', [
                'nim'   => $nim,
                'nama'  => $nama,
                'tahun' => $tahun
            ]);
        }

        return $success;
    }

    /**
     * Update data mahasiswa
     */
    public function update($id, $nim, $nama, $tahun)
    {
        $stmt = $this->conn->prepare(
            "UPDATE mahasiswa
             SET nim = ?, nama = ?, tahun_angkatan = ?
             WHERE id = ?"
        );

        $stmt->bind_param("ssii", $nim, $nama, $tahun, $id);

        $success = $stmt->execute();

        if ($success) {
            Logger::log('UPDATE_MAHASISWA', [
                'id'    => $id,
                'nim'   => $nim,
                'nama'  => $nama,
                'tahun' => $tahun
            ]);
        }

        return $success;
    }

    /**
     * Hapus data mahasiswa
     */
    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM mahasiswa WHERE id = ?"
        );

        $stmt->bind_param("i", $id);

        $success = $stmt->execute();

        if ($success) {
            Logger::log('DELETE_MAHASISWA', [
                'id' => $id
            ]);
        }

        return $success;
    }
}
