<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Template.php'); 

$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$jurusan->open();

$data .= '<div class="card-header text-center">
<h3 class="my-0">Create data Jurusan</h3>
</div>
<div class="card-body">
    <form method="post" action="jurusan.php" enctype="multipart/form-data">
        <div class="form-group">
        <label for="nama_jurusan">Jurusan</label>
        <input type="text" class="form-control" id="nama" name="nama_jurusan" required>
        </div>
        <br>
        </div>
        <br>
        <div class="card-footer text-end">
            <a href="index.php"><button type="submit" name="submit" class="btn btn-success text-white">Create Data</button></a>
        </div>
    </form>
    <div>';

$jurusan->close();

$detail = new Template('templates/skinform.html');
$detail->replace('DATA_ADD_JURUSAN', $data);
$detail->write();
