<?php

class Jurusan extends DB
{
    function getJurusan()
    {
        $query = "SELECT * FROM jurusan";
        return $this->execute($query);
    }

    function getJurusanById($id)
    {
        $query = "SELECT * FROM jurusan WHERE id_jurusan = $id";
        return $this->execute($query);
    }

    function addData($data)
    {
        $nama_jurusan = $data['nama_jurusan'];
        $query = "INSERT INTO jurusan VALUES('', '$nama_jurusan')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data)
    {
        $nama_jurusan = $data['nama_jurusan'];
        $query = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan' WHERE id_jurusan = '$id'";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM jurusan WHERE id_jurusan = $id";
        return $this->executeAffected($query);
    }
}
