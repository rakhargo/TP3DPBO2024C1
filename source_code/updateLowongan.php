<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Lowongan.php');
include('classes/Template.php'); 

$lowongan = new Lowongan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$lowongan->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $lowongan->getLowonganById($id);
        $row = $lowongan->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Update Data ' . $row['nama_lowongan'] . '</h3>
        </div>
        <div class="card-body">
            <form method="post" action="lowongan.php?id=' . $id . '" enctype="multipart/form-data">
                <input type="hidden" name="id" value="' . $row['id_lowongan'] . '">
                <br>
                <div class="form-group">
                    <label for="nama">Nama Lowongan</label>
                    <input type="text" class="form-control" id="nama" name="nama_lowongan" value="' . $row['nama_lowongan'] . '" required>
                </div>

                <br>
                <div class="card-footer text-end">
                    <a href="lowongan.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Ubah Data</button></a>
                </div>
            </form>
            <div>';
        }
    }

$lowongan->close();
$detail = new Template('templates/skinform.html');
$detail->replace('DATA_UPDATE_LOWONGAN', $data);
$detail->write();
