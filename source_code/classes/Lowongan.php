<?php

class Lowongan extends DB
{
    function getLowongan()
    {
        $query = "SELECT * FROM lowongan";
        return $this->execute($query);
    }

    function getLowonganById($id)
    {
        $query = "SELECT * FROM lowongan WHERE id_lowongan = $id";
        return $this->execute($query);
    }

    function addData($data)
    {
        $nama_lowongan = $data['nama_lowongan'];
        $query = "INSERT INTO lowongan VALUES('', '$nama_lowongan')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data)
    {
        $nama_lowongan = $data['nama_lowongan'];
        $query = "UPDATE lowongan SET nama_lowongan = '$nama_lowongan' WHERE id_lowongan = '$id'";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM lowongan WHERE id_lowongan = $id";
        return $this->executeAffected($query);
    }
}
