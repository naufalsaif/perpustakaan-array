<?php
session_start();
// setting waktu jakarta
date_default_timezone_set('Asia/Jakarta');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="img/novtech.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- font-awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- my css -->
    <style>
        .footer-login {
            position: relative;
            top: -60px;
            padding-top: 6px;
            height: 40px;
            font-weight: bold;
        }

        .card-book {
            width: 100%;
            height: 480px;
            margin: 0 auto;
            background: #fff;
            transition: 0.5s;
        }

        .card-book:hover {
            box-shadow: 0 10px 10px rgba(0, 0, 0, .3);
        }

        .card-book .face {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-book .face.face1 {
            box-sizing: border-box;
            padding: 20px;
            text-align: center;
            background: #fff;
            color: #000;
        }

        .card-book .face.face1 h4 {
            margin-top: 40px;
        }

        .card-book .face.face2 {
            background: #0D6EFD;
            transition: 0.5s;
        }

        .card-book:hover .face.face2 {
            height: 80px;
            width: 80px;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            background: transparent;
        }

        .card-book .face.face2 img {
            width: 100%;
            height: 100%;
        }

        .card-book:hover .face.face2 img {
            width: 70px;
            height: 100px;
        }

        /* mobile Version */
        @media (max-width: 540px) {
            .konten-tengah {
                margin: 0 auto;
            }

            /*
            .tambah-buku {
                margin-left: 9% !important;
            } */
        }
    </style>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'login':
                echo '<title>Login</title>
                </head>
                <body class="bg-primary">';
                break;
            case 'registrasi':
                echo '<title>Registrasi</title>
                </head>
                <body class="bg-primary">';
                break;
            case 'home':
                echo '<title>Home</title>
                </head>
                <body>';
                break;
            case 'tambah_buku':
                echo '<title>Form Tambah Buku</title>
                </head>
                <body>';
                break;
            case 'edit_buku':
                echo '<title>Form Edit Buku</title>
                </head>
                <body>';
                break;
            case 'hapus_buku':
                echo '<title>Hapus Buku</title>
                </head>
                <body>';
                break;
            case 'lihat_buku':
                echo '<title>Lihat Buku</title>
                </head>
                <body>';
                break;
            case 'pinjam_buku':
                echo '<title>Pinjam Buku</title>
                </head>
                <body>';
                break;
            case 'history':
                echo '<title>History</title>
                </head>
                <body>';
                break;
            case 'kembali_buku':
                echo '<title>Kembalikan Buku</title>
                </head>
                <body>';
                break;
            case 'akun':
                echo '<title>Pengaturan Akun</title>
                </head>
                <body>';
                break;
            case 'ubah_nama':
                echo '<title>Ubah Nama</title>
                </head>
                <body>';
                break;
            case 'ubah_email':
                echo '<title>Ubah Email</title>
                </head>
                <body>';
                break;
            case 'ubah_password':
                echo '<title>Ubah Password</title>
                </head>
                <body>';
                break;
            default:
                echo '<title>Login</title>
                </head>
                <body class="bg-primary">';
                break;
        }
    } else {
        echo '<title>Login</title>
        </head>
        <body class="bg-primary">';
    }
    ?>


    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'login':
                include "halaman/login.php";
                break;
            case 'registrasi':
                include "halaman/registrasi.php";
                break;
            case 'home':
                include "templates/menu.php";
                include "halaman/home.php";
                include "templates/footer.php";
                break;
            case 'tambah_buku':
                include "templates/menu.php";
                include "halaman/tambah_buku.php";
                include "templates/footer.php";
                break;
            case 'edit_buku':
                include "templates/menu.php";
                include "halaman/edit_buku.php";
                include "templates/footer.php";
                break;
            case 'hapus_buku':
                include "algoritma/hapus_buku.php";
                break;
            case 'lihat_buku':
                include "templates/menu.php";
                include "halaman/lihat_buku.php";
                include "templates/footer.php";
                break;
            case 'pinjam_buku':
                include "algoritma/pinjam_buku.php";
                break;
            case 'history':
                include "templates/menu.php";
                include "halaman/history.php";
                include "templates/footer.php";
                break;
            case 'kembali_buku':
                include "algoritma/kembali_buku.php";
                break;
            case 'akun':
                include "templates/menu.php";
                include "halaman/akun.php";
                include "templates/footer.php";
                break;
            case 'ubah_nama':
                include "templates/menu.php";
                include "halaman/ubah_nama.php";
                include "templates/footer.php";
                break;
            case 'ubah_email':
                include "templates/menu.php";
                include "halaman/ubah_email.php";
                include "templates/footer.php";
                break;
            case 'ubah_password':
                include "templates/menu.php";
                include "halaman/ubah_password.php";
                include "templates/footer.php";
                break;
            default:
                include "halaman/login.php";
                break;
        }
    } else {
        include "halaman/login.php";
    }

    ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </body>

</html>