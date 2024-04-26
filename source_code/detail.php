<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Lowongan.php');
include('classes/Pelamar.php');
include('classes/Template.php'); 

$pelamar = new Pelamar($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pelamar->open();

$id = $_GET['id'];
$data = nulL;

if (isset($_POST['submit'])) 
{
    if ($pelamar->updateData($id, $_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'detail.php?id=$id';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'detail.php?id=$id';
        </script>";
    }
}

if (isset($id)) {
    if ($id > 0) {
        $pelamar->getPelamarById($id);
        $row = $pelamar->getResult();
        
        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body text-end">
        <div class="row mb-5">
        <div class="col-3">
        <div class="row justify-content-center">
        <img src="assets/data_images/' . $row['pasfoto'] . '" class="img-thumbnail" alt="' . $row['pasfoto'] . '" width="60">
        </div>
        </div>
        <div class="col-9">
        <div class="card px-3">
        <table border="0" class="text-start">
        <tr>
        <td>Nama</td>
        <td>:</td>
        <td>' . $row['nama'] . '</td>
        </tr>
        <tr>
        <td>Domisili</td>
        <td>:</td>
        <td>' . $row['domisili'] . '</td>
        </tr>
        <tr>
        <td>Lowongan yang dilamar</td>
        <td>:</td>
                    <td>' . $row['nama_lowongan'] . '</td>
                </tr>
                <tr>
                    <td>Asal Jurusan</td>
                    <td>:</td>
                    <td>' . $row['nama_jurusan'] . '</td>
                    </tr>
            </table>
        </div>
        </div>
        </div>
        </div>
        <div class="card-footer text-end">
            <div class="row mb-2">
            <a href="update.php?id=' . $id . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
            </div>
            <div class="row mb-2">
                <form method="post" action="index.php">
                    <input type="hidden" name="id" value="' . $id . '">
                    <button type="submit" name="delete" class="btn btn-danger">Hapus Data</button>
                </form>
            </div>
        </div>';
    }
}
$pelamar->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PELAMAR', $data);
$detail->write();
