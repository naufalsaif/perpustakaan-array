<?php

// function buat_file($data)
// {
//     if (!file_exists($data)) {
//         fopen($data, 'w');
//     } else {
//         'File sudah ada';
//     }
// }

// function delete_file($data)
// {
//     if (file_exists($data)) {
//         unlink($data);
//     } else {
//         'File tidak ditemukan';
//     }
// }

function redirect_page($data)
{
    echo "<script>document.location.href = 'index.php?page=" . $data . "';</script>";
}

function logout()
{
    session_unset();
    session_destroy();
    redirect_page("login");
}

function url_tujuan($data)
{
    return "index.php?page=$data";
}

function message_alert($message)
{
    echo "<script>alert('" . $message . "');</script>";
}

function substr_karakter($input)
{
    $kata = substr($input, 0, 100);
    $jumlah = strlen($input);
    $kalimat = $kata . ($jumlah > 100 ? '...' : '');
    return $kalimat;
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        message_alert("Pilih gambar terlebih dahulu!");
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        message_alert("Yang anda upload bukan gambar!");
        return false;
    }

    // cek jika ukurannya terlalu besar(lebih dari 1mb)
    if ($ukuranFile > 1000000) {
        message_alert("Ukuran gambar terlalu besar!");
        return false;
    }

    // lolos pengecekan, gambar siap upload
    // genarate nama gambar baru
    $namaFileBaru = time() . rand(0, 99999);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/buku/' . $namaFileBaru);

    return $namaFileBaru;
}

function upload_edit($gambarlama)
{


    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        message_alert("Pilih gambar terlebih dahulu!");
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        message_alert("Yang anda upload bukan gambar!");
        return false;
    }

    // cek jika ukurannya terlalu besar(lebih dari 1mb)
    if ($ukuranFile > 1000000) {
        message_alert("Ukuran gambar terlalu besar!");
        return false;
    }

    // lolos pengecekan, gambar siap upload
    // genarate nama gambar baru
    $namaFileBaru = time() . rand(0, 99999);
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/buku/' . $namaFileBaru);

    // hapus gambar lama
    unlink("img/buku/" . $gambarlama);

    return $namaFileBaru;
}

function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}
