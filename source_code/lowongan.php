<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Lowongan.php');
include('classes/Template.php');

$lowongan = new Lowongan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$lowongan->open();
$lowongan->getLowongan();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($lowongan->addData($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'lowongan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'lowongan.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Lowongan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Lowongan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'lowongan';

while ($low = $lowongan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $low['nama_lowongan'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateLowongan.php?id=' . $low['id_lowongan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="lowongan.php?hapus=' . $low['id_lowongan'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($lowongan->updateData($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'lowongan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'lowongan.php';
            </script>";
            }
        }

        $lowongan->getLowonganById($id);
        $row = $lowongan->getResult();

        $dataUpdate = $row['nama_lowongan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($lowongan->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'lowongan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'lowongan.php';
            </script>";
        }
    }
}

$lowongan->close();

$view->replace('LINK_CREATE', "tambahLowongan.php");
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
