<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Lowongan.php');
include('classes/Pelamar.php');
include('classes/Template.php'); 

// buat instance pengurus
$listPelamar = new Pelamar($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPelamar->open();
// tampilkan data pengurus

// cari pengurus
if (isset($_POST['btn-cari'])) 
{

    $listPelamar->searchPelamar($_POST['cari']);
    if ($listPelamar->getAffected() < 1) {
        echo "<script>
            alert('Data gagal ditemukan!');
            document.location.href = 'index.php';
        </script>";
    }
    // $listPelamar->getResult();
} 
else 
{
    $sortBy = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'id_pelamar';
    $sortDir = isset($_POST['sort_dir']) ? $_POST['sort_dir'] : 'ASC';

    $listPelamar->getPelamarJoin($sortBy, $sortDir);

}
    
$data = null;

if (isset($_POST['delete'])) 
{
    if ($listPelamar->deleteData($_POST['id']) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'index.php';
        </script>";
    }
}

if (isset($_POST['submit'])) 
{
    if ($listPelamar->addData($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil dibuat!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dibuat!');
        document.location.href = 'index.php';
        </script>";
    }
}

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPelamar->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pelamar-thumbnail">
        <a href="detail.php?id=' . $row['id_pelamar'] . '">
            <div class="row justify-content-center">
                <img src="assets/data_images/' . $row['pasfoto'] . '" class="card-img-top" alt="' . $row['pasfoto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pelamar-nama my-0">' . $row['nama'] . '</p>
                <p class="card-text lowongan-nama">' . $row['nama_lowongan'] . '</p>
                </div>
        </a>
    </div>    
    </div>';
}
// tutup koneksi
$listPelamar->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PELAMAR', $data);
$home->write();