<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Lowongan.php');
include('classes/Pelamar.php');
include('classes/Template.php'); 

$pelamar = new Pelamar($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lowongan = new Lowongan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$pelamar->open();
$lowongan->open();
$jurusan->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pelamar->getPelamarById($id);
        $lowongan->getLowongan();
        $jurusan->getJurusan();
        $row = $pelamar->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Update Data ' . $row['nama'] . '</h3>
        </div>
        <div class="card-body">
            <form method="post" action="detail.php?id=' . $id . '" enctype="multipart/form-data">
                <input type="hidden" name="id" value="' . $row['id_pelamar'] . '">
                <span>
                    <img src="assets/data_images/' . $row['pasfoto'] . '">
                </span>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <br>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                </div>
                <br>
                <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $row['nama'] . '" required>
                </div>
                <br>
                <div class="form-group">
                <label for="domisili">Domisili</label>
                <input type="text" class="form-control" id="domisili" name="domisili" value="' . $row['domisili'] . '" required>
                </div>
                <br>
                <div class="form-group">
                <label for="lowongan">Lowongan yang dilamar</label>
                <select class="form-select" name="lowongan">';
                
                while ($rowLowongan = $lowongan->getResult()) {
                    $data .= '<option value="' . $rowLowongan['id_lowongan'] . '"';
                    if ($rowLowongan['nama_lowongan'] == $row['nama_lowongan']) {
                        $data .= ' selected';
                    }
                    $data .= '>' . $rowLowongan['nama_lowongan'] . '</option>';
                }
                
                $data .= '</select>
                </div>
                <br> 
                <div class="form-group">
                <label for="jurusan">Asal Jurusan</label>
                <select class="form-select" name="jurusan">';
                
                while ($rowJurusan = $jurusan->getResult()) {
                    $data .= '<option value="' . $rowJurusan['id_jurusan'] . '"';
                    if ($rowJurusan['nama_jurusan'] == $row['nama_jurusan']) {
                        $data .= ' selected';
                    }
                    $data .= '>' . $rowJurusan['nama_jurusan'] . '</option>';
                }
                $data .= '</select>
                </div>
                <br>
                <div class="card-footer text-end">
                    <a href="detail.php?id=' . $id . '"><button type="submit" name="submit" class="btn btn-success text-white">Ubah Data</button></a>
                </div>
            </form>
            <div>';
        }
    }

$pelamar->close();
$detail = new Template('templates/skinform.html');
$detail->replace('DATA_UPDATE_PELAMAR', $data);
$detail->write();
