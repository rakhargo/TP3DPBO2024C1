<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Template.php'); 

$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$jurusan->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $jurusan->getJurusanById($id);
        $row = $jurusan->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Update Data ' . $row['nama_jurusan'] . '</h3>
        </div>
        <div class="card-body">
            <form method="post" action="jurusan.php?id=' . $id . '" enctype="multipart/form-data">
                <input type="hidden" name="id" value="' . $row['id_jurusan'] . '">
                <br>
                <div class="form-group">
                    <label for="nama">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama" name="nama_jurusan" value="' . $row['nama_jurusan'] . '" required>
                </div>

                <br>
                <div class="card-footer text-end">
                    <a href="jurusan.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Ubah Data</button></a>
                </div>
            </form>
            <div>';
        }
    }

$jurusan->close();
$detail = new Template('templates/skinform.html');
$detail->replace('DATA_UPDATE_JURUSAN', $data);
$detail->write();
