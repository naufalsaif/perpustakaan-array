<?php
include "functions.php";

function insert_pinjam()
{
    include('database/akun.php');
    $no_index_akun = $_SESSION['id_akun'];
    $data_akun = $akun[$no_index_akun];

    include('database/buku.php');
    $no_index = $_GET['no_index'];
    // mengambil data buku
    $data_buku = $buku[$no_index];

    $pinjam = 'pinjam[] = [';
    //Fungsi extract() mengimpor variabel ke dalam tabel simbol lokal dari sebuah array.
    extract($_REQUEST);
    $file = fopen("database/pinjam.php", "a");
    fwrite($file, "$$pinjam" . "\n");
    fwrite($file, '"id" => "' . time() . rand(0, 99) . '",' . "\n");
    fwrite($file, '"email" => "' . $data_akun['email'] . '",' . "\n");
    fwrite($file, '"judul_buku" => "' . $data_buku['judul_buku'] . '",' . "\n");
    fwrite($file, '"tanggal_pinjam" => "' . time() . '",' . "\n");
    fwrite($file, '"tanggal_kembali" => "",' . "\n");
    fwrite($file, '"id_buku" => "' . $data_buku['id'] . '",' . "\n");
    fwrite($file, '];' . "\n");
    fclose($file);
}


// masukkan data edit 
function edit_data()
{
    include('database/buku.php');
    $no_index = $_GET['no_index'];
    // mengambil data buku
    $data_buku = $buku[$no_index];
    // mengurangi stok
    $stok_buku_new = $data_buku["stok_buku"] - 1;

    $buku = "buku[$no_index] = [";
    extract($_REQUEST);
    $file = fopen("database/buku.php", "a");
    fwrite($file, "$$buku" . "\n");
    fwrite($file, '"id" => "' . $data_buku["id"] . '",' . "\n");
    fwrite($file, '"isbn" => "' . $data_buku["isbn"] . '",' . "\n");
    fwrite($file, '"judul_buku" => "' . $data_buku["judul_buku"] . '",' . "\n");
    fwrite($file, '"penulis_buku" => "' . $data_buku["penulis_buku"] . '",' . "\n");
    fwrite($file, '"penerbit_buku" => "' . $data_buku["penerbit_buku"] . '",' . "\n");
    fwrite($file, '"tahun_terbit" => "' . $data_buku["tahun_terbit"] . '",' . "\n");
    fwrite($file, '"halaman" => "' . $data_buku["halaman"] . '",' . "\n");
    fwrite($file, '"deskripsi" => "' . $data_buku["deskripsi"] . '",' . "\n");
    fwrite($file, '"stok_buku" => "' . $stok_buku_new . '",' . "\n");
    fwrite($file, '"gambar" => "' . $data_buku["gambar"] . '",' . "\n");
    fwrite($file, '];' . "\n");
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

// masukkan data ke file temp
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

// redirect home
function redirect_home()
{
    message_alert("Anda berhasil meminjam buku, mohon dijaga dan kembalikan jika sudah selesai!");
    redirect_page("home");
}

// run function
insert_pinjam();
edit_data();
newfile_temp();
insert_temp();
delete_database_buku();
newfile_database_buku();
insert_database_buku();
delete_temp();
redirect_home();
