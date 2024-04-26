<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Template.php');

$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jurusan->open();
$jurusan->getJurusan();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($jurusan->addData($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'jurusan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'jurusan.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Jurusan';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Jurusan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'jurusan';

while ($jur = $jurusan->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $jur['nama_jurusan'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateJurusan.php?id=' . $jur['id_jurusan'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
        <a href="jurusan.php?hapus=' . $jur['id_jurusan'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($jurusan->updateData($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'jurusan.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'jurusan.php';
            </script>";
            }
        }

        $jurusan->getJurusanById($id);
        $row = $jurusan->getResult();

        $dataUpdate = $row['nama_jurusan'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jurusan->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jurusan.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jurusan.php';
            </script>";
        }
    }
}

$jurusan->close();

$view->replace('LINK_CREATE', "tambahJurusan.php");
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
