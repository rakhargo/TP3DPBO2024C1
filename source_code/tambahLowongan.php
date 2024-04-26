<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Lowongan.php');
include('classes/Template.php'); 

$lowongan = new Lowongan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$lowongan->open();

$data .= '<div class="card-header text-center">
<h3 class="my-0">Create data Lowongan</h3>
</div>
<div class="card-body">
    <form method="post" action="lowongan.php" enctype="multipart/form-data">
        <div class="form-group">
        <label for="nama_lowongan">Lowongan</label>
        <input type="text" class="form-control" id="nama" name="nama_lowongan" required>
        </div>
        <br>
        </div>
        <br>
        <div class="card-footer text-end">
            <a href="index.php"><button type="submit" name="submit" class="btn btn-success text-white">Create Data</button></a>
        </div>
    </form>
    <div>';

$lowongan->close();

$detail = new Template('templates/skinform.html');
$detail->replace('DATA_ADD_LOWONGAN', $data);
$detail->write();
