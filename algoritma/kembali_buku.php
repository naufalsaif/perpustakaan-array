<?php
include "functions.php";

// ubah database pinjam
function edit_pinjam()
{
    include('database/pinjam.php');
    $no_index = $_GET['no_index'];
    // mengambil data buku
    $data_pinjam = $pinjam[$no_index];

    $pinjam = "pinjam[$no_index] = [";
    $file = fopen("database/pinjam.php", "a");
    fwrite($file, "$$pinjam" . "\n");
    fwrite($file, '"id" => "' . $data_pinjam['id'] . '",' . "\n");
    fwrite($file, '"email" => "' . $data_pinjam['email'] . '",' . "\n");
    fwrite($file, '"judul_buku" => "' . $data_pinjam['judul_buku'] . '",' . "\n");
    fwrite($file, '"tanggal_pinjam" => "' . $data_pinjam['tanggal_pinjam'] . '",' . "\n");
    fwrite($file, '"tanggal_kembali" => "' . time() . '",' . "\n");
    fwrite($file, '"id_buku" => "' . $data_pinjam['id_buku'] . '",' . "\n");
    fwrite($file, '];' . "\n");
    fclose($file);
}

// membuat file temp
function newfile_temp_pinjam()
{
    if (!file_exists('database/temp.php')) {
        fopen('database/temp.php', 'w');
    } else {
        'File sudah ada';
    }
}

// masukkan data ke file temp
function insert_temp_pinjam()
{
    include('database/pinjam.php');
    $pinjam2 = 'pinjam[] = [';
    $file = fopen("database/temp.php", "a");
    fwrite($file, "<?php" . "\n");
    fclose($file);
    foreach ($pinjam as $p) {
        $file = fopen("database/temp.php", "a");
        fwrite($file, "$$pinjam2" . "\n");
        fwrite($file, '"id" => "' . $p['id'] . '",' . "\n");
        fwrite($file, '"email" => "' . $p['email'] . '",' . "\n");
        fwrite($file, '"judul_buku" => "' . $p['judul_buku'] . '",' . "\n");
        fwrite($file, '"tanggal_pinjam" => "' . $p['tanggal_pinjam'] . '",' . "\n");
        fwrite($file, '"tanggal_kembali" => "' . $p['tanggal_kembali'] . '",' . "\n");
        fwrite($file, '"id_buku" => "' . $p['id_buku'] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }
}

// delete file database_pinjam
function delete_database_pinjam()
{
    $file_database_pinjam = 'database/pinjam.php';
    if (file_exists($file_database_pinjam)) {
        unlink($file_database_pinjam);
        'File berhasil di hapus';
    } else {
        'File tidak ditemukan';
    }
}

// buat file database_pinjam
function newfile_database_pinjam()
{
    if (!file_exists('database/pinjam.php')) {
        fopen('database/pinjam.php', 'w');
    } else {
        'File sudah ada';
    }
}

// masukkan data file database_pinjam
function insert_pinjam()
{
    include('database/temp.php');
    $pinjam2 = 'pinjam[] = [';
    $file = fopen("database/pinjam.php", "a");
    fwrite($file, "<?php" . "\n");
    fclose($file);
    foreach ($pinjam as $p) {
        $file = fopen("database/pinjam.php", "a");
        fwrite($file, "$$pinjam2" . "\n");
        fwrite($file, '"id" => "' . $p['id'] . '",' . "\n");
        fwrite($file, '"email" => "' . $p['email'] . '",' . "\n");
        fwrite($file, '"judul_buku" => "' . $p['judul_buku'] . '",' . "\n");
        fwrite($file, '"tanggal_pinjam" => "' . $p['tanggal_pinjam'] . '",' . "\n");
        fwrite($file, '"tanggal_kembali" => "' . $p['tanggal_kembali'] . '",' . "\n");
        fwrite($file, '"id_buku" => "' . $p['id_buku'] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }
}

// hapus file temp
function delete_temp_pinjam()
{
    $file_temp = 'database/temp.php';
    if (file_exists($file_temp)) {
        unlink($file_temp);
        'File berhasil di hapus';
    } else {
        'File tidak ditemukan';
    }
}



// algoritma manage database buku
// edit buku
function edit_buku()
{
    include("database/buku.php");
    include("database/pinjam.php");
    $no_index = $_GET['no_index'];
    // mengambil data buku
    $data_pinjam = $pinjam[$no_index];
    $no = 0;
    foreach ($buku as $b) {
        if ($b['id'] == $data_pinjam['id_buku']) {
            $no_index_buku = $no;
        }
        $no++;
    }

    $data_buku = $buku[$no_index_buku];
    $stok_new = $data_buku["stok_buku"] + 1;
    $buku2 = "buku[$no_index_buku] = [";
    $file = fopen("database/buku.php", "a");

    fwrite($file, "$$buku2" . "\n");
    fwrite($file, '"id" => "' . $data_buku["id"] . '",' . "\n");
    fwrite($file, '"isbn" => "' . $data_buku["isbn"] . '",' . "\n");
    fwrite($file, '"judul_buku" => "' . $data_buku["judul_buku"] . '",' . "\n");
    fwrite($file, '"penulis_buku" => "' . $data_buku["penulis_buku"] . '",' . "\n");
    fwrite($file, '"penerbit_buku" => "' . $data_buku["penerbit_buku"] . '",' . "\n");
    fwrite($file, '"tahun_terbit" => "' . $data_buku["tahun_terbit"] . '",' . "\n");
    fwrite($file, '"halaman" => "' . $data_buku["halaman"] . '",' . "\n");
    fwrite($file, '"deskripsi" => "' . $data_buku["deskripsi"] . '",' . "\n");
    fwrite($file, '"stok_buku" => "' . $stok_new . '",' . "\n");
    fwrite($file, '"gambar" => "' . $data_buku["gambar"] . '",' . "\n");
    fwrite($file, '];' . "\n");
    fclose($file);
}

// membuat file temp
function newfile_temp_buku()
{
    if (!file_exists('database/temp.php')) {
        fopen('database/temp.php', 'w');
    } else {
        'File sudah ada';
    }
}

// masukkan data ke file temp
function insert_temp_buku()
{
    include('database/buku.php');
    $buku2 = 'buku[] = [';
    $file = fopen("database/temp.php", "a");
    fwrite($file, "<?php" . "\n");
    fclose($file);
    foreach ($buku as $b) {
        $file = fopen("database/temp.php", "a");
        fwrite($file, "$$buku2" . "\n");
        fwrite($file, '"id" => "' . $b["id"] . '",' . "\n");
        fwrite($file, '"isbn" => "' . $b["isbn"] . '",' . "\n");
        fwrite($file, '"judul_buku" => "' . $b["judul_buku"] . '",' . "\n");
        fwrite($file, '"penulis_buku" => "' . $b["penulis_buku"] . '",' . "\n");
        fwrite($file, '"penerbit_buku" => "' . $b["penerbit_buku"] . '",' . "\n");
        fwrite($file, '"tahun_terbit" => "' . $b["tahun_terbit"] . '",' . "\n");
        fwrite($file, '"halaman" => "' . $b["halaman"] . '",' . "\n");
        fwrite($file, '"deskripsi" => "' . $b["deskripsi"] . '",' . "\n");
        fwrite($file, '"stok_buku" => "' . $b["stok_buku"] . '",' . "\n");
        fwrite($file, '"gambar" => "' . $b["gambar"] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }
}

// hapus file database_buku
function delete_database_buku()
{
    $file_database_buku = 'database/buku.php';
    if (file_exists($file_database_buku)) {
        unlink($file_database_buku);
        'File berhasil di hapus';
    } else {
        'File tidak ditemukan';
    }
}

// buat file database_buku
function newfile_database_buku()
{
    if (!file_exists('database/buku.php')) {
        fopen('database/buku.php', 'w');
    } else {
        'File sudah ada';
    }
}

// masukkan data ke file database_buku
function insert_database_buku()
{
    include('database/temp.php');
    $buku3 = 'buku[] = [';
    $file = fopen("database/buku.php", "a");
    fwrite($file, "<?php" . "\n");
    fclose($file);
    foreach ($buku as $b) {
        $file = fopen("database/buku.php", "a");
        fwrite($file, "$$buku3" . "\n");
        fwrite($file, '"id" => "' . $b["id"] . '",' . "\n");
        fwrite($file, '"isbn" => "' . $b["isbn"] . '",' . "\n");
        fwrite($file, '"judul_buku" => "' . $b["judul_buku"] . '",' . "\n");
        fwrite($file, '"penulis_buku" => "' . $b["penulis_buku"] . '",' . "\n");
        fwrite($file, '"penerbit_buku" => "' . $b["penerbit_buku"] . '",' . "\n");
        fwrite($file, '"tahun_terbit" => "' . $b["tahun_terbit"] . '",' . "\n");
        fwrite($file, '"halaman" => "' . $b["halaman"] . '",' . "\n");
        fwrite($file, '"deskripsi" => "' . $b["deskripsi"] . '",' . "\n");
        fwrite($file, '"stok_buku" => "' . $b["stok_buku"] . '",' . "\n");
        fwrite($file, '"gambar" => "' . $b["gambar"] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }
}

// hapus file temp
function delete_temp_buku()
{
    $file_temp = 'database/temp.php';
    if (file_exists($file_temp)) {
        unlink($file_temp);
        'File berhasil di hapus';
    } else {
        'File tidak ditemukan';
    }
}

// redirect home
function redirect_history()
{
    message_alert("Buku berhasil dikembalikan, terimakasih!");
    redirect_page("history");
}

// run untuk manage database_pinjam
edit_pinjam();
newfile_temp_pinjam();
insert_temp_pinjam();
delete_database_pinjam();
newfile_database_pinjam();
insert_pinjam();
delete_temp_pinjam();

// run untuk manage database_buku
edit_buku();
newfile_temp_buku();
insert_temp_buku();
delete_database_buku();
newfile_database_buku();
insert_database_buku();
delete_temp_buku();

// run redirect ke history
redirect_history();
