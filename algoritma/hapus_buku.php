<?php
include "functions.php";

// hapus gambar
function hapus_gambar()
{
    include "database/buku.php";
    $no_index = $_GET['no_index'];
    $data_buku = $buku[$no_index];
    unlink("img/buku/" . $data_buku['gambar']);
}


// // menghapus data
function hapus_data()
{
    $no_index = $_GET['no_index'];
    $data = 'unset($buku[' . $no_index . ']);';
    $file = fopen("database/buku.php", "a");
    fwrite($file, "$data" . "\n");
    fclose($file);
}

// membuat file temp
function newfile_temp()
{
    if (!file_exists('database/temp.php')) {
        fopen('database/temp.php', 'w');
    } else {
        'File sudah ada';
    }
}

// // masukkan data ke file temp
function insert_temp()
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

// delete file database_buku
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

// // masukkan data ke database_buku
function insert_database_buku()
{
    $buku = [];
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

// // hapus file temp
function delete_temp()
{
    $file_temp = 'database/temp.php';
    if (file_exists($file_temp)) {
        unlink($file_temp);
        'File berhasil di hapus';
    } else {
        'File tidak ditemukan';
    }
}

// pindah halaman
function redirect_home()
{
    message_alert("Buku berhasil dihapus!");
    redirect_page("home");
}


// menjalankan program
hapus_gambar();
hapus_data();
newfile_temp();
insert_temp();
delete_database_buku();
newfile_database_buku();
insert_database_buku();
delete_temp();
redirect_home();
