<?php
namespace App;

interface CrudInterface
{
    public function getAll();
    public function getById($id);
    public function create($nim, $nama, $tahun);
    public function update($id, $nim, $nama, $tahun);
    public function delete($id);
}
