<?php

class Pelamar extends DB
{
    function getPelamarJoin($sortBy = 'id_pelamar', $sortDirection = 'ASC')
    {
        // $query = "SELECT * FROM pelamar JOIN lowongan ON pelamar.id_lowongan=lowongan.id_lowongan JOIN jurusan ON pelamar.id_jurusan=jurusan.id_jurusan ORDER BY pelamar.id_pelamar";

        // return $this->execute($query);
        $query = "SELECT * FROM pelamar 
        JOIN lowongan ON pelamar.id_lowongan=lowongan.id_lowongan 
        JOIN jurusan ON pelamar.id_jurusan=jurusan.id_jurusan 
        ORDER BY $sortBy $sortDirection";

        return $this->execute($query);
    }

    function getPelamar()
    {
        $query = "SELECT * FROM pelamar";
        return $this->execute($query);
    }

    function getPelamarById($id)
    {
        $query = "SELECT * FROM pelamar JOIN lowongan ON pelamar.id_lowongan=lowongan.id_lowongan JOIN jurusan ON pelamar.id_jurusan=jurusan.id_jurusan WHERE id_pelamar=$id";
        return $this->execute($query);
    }

    function searchPelamar($keyword)
    {
        $query = "SELECT * FROM pelamar JOIN lowongan ON pelamar.id_lowongan=lowongan.id_lowongan JOIN jurusan ON pelamar.id_jurusan=jurusan.id_jurusan WHERE nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    // function getSortPelamar($sortBy = 'id_pelamar', $sortDirection = 'ASC')
    // {
    //     $query = "SELECT * FROM pelamar 
    //     JOIN lowongan ON pelamar.id_lowongan=lowongan.id_lowongan 
    //     JOIN jurusan ON pelamar.id_jurusan=jurusan.id_jurusan 
    //     ORDER BY $sortBy $sortDirection";

    //     return $this->execute($query);
    // }

    function addData($data, $file)
    {
        $this->execute("SELECT MAX(id_pelamar) AS last_id FROM pelamar");
        $result = $this->getResult();

        $id = $result['last_id'] + 1;
        $nama = $data['nama'];
        $domisili = $data['domisili'];
        $pasfoto = $file['foto']['name'];
        $lowongan = $data['lowongan'];
        $jurusan = $data['jurusan'];
        if($pasfoto != "") 
        {
            $x = explode('.', $pasfoto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $nama_gambar_baru = $id.'.'.$ekstensi;
            
            move_uploaded_file($file_tmp, 'assets/data_images/'.$nama_gambar_baru);
            
            $query = "INSERT INTO pelamar VALUES('', '$nama', '$domisili', '$nama_gambar_baru', '$lowongan', '$jurusan')";
        }
        return $this->executeAffected($query);
    }
    
    function updateData($id, $data, $file)
    {
        $nama = $data['nama'];
        $domisili = $data['domisili'];
        $pasfoto = $file['foto']['name'];
        $lowongan = $data['lowongan'];
        $jurusan = $data['jurusan'];
        
        if($pasfoto != "") 
        {
            $this->execute("SELECT pasfoto FROM pelamar WHERE id_pelamar = '$id'");
            $result = $this->getResult();
            $nama_gambar_lama = $result['pasfoto'];

            if (file_exists('assets/data_images/'.$nama_gambar_lama)) 
            {
                unlink('assets/data_images/'.$nama_gambar_lama);
            }

            $x = explode('.', $pasfoto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $nama_gambar_baru = $id.'.'.$ekstensi;
            
            move_uploaded_file($file_tmp, 'assets/data_images/'.$nama_gambar_baru);
            
            $query = "UPDATE pelamar SET nama = '$nama', domisili = '$domisili', pasfoto = '$nama_gambar_baru', id_lowongan = '$lowongan', id_jurusan = '$jurusan' WHERE id_pelamar = '$id'";
        }
        else
        {
            $query = "UPDATE pelamar SET nama = '$nama', domisili = '$domisili', id_lowongan = '$lowongan', id_jurusan = '$jurusan' WHERE id_pelamar = '$id'";
        }
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $this->execute("SELECT pasfoto FROM pelamar WHERE id_pelamar = '$id'");
        $result = $this->getResult();
        $nama_gambar_lama = $result['pasfoto'];

        if (file_exists('assets/data_images/'.$nama_gambar_lama)) 
        {
            unlink('assets/data_images/'.$nama_gambar_lama);
        }
        $query = "DELETE FROM pelamar WHERE id_pelamar = $id";
        
        return $this->executeAffected($query);
    }
}
