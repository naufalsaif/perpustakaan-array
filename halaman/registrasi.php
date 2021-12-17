<?php
include "functions.php";
if (isset($_SESSION["session_login"])) {
    redirect_page("home");
}

// variabel kosong
$message = "";
$email = "";
$nama = "";

// jika tombol submit ditekan
if (isset($_POST['submit'])) {
    $email_ada = "";
    $akun = [];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    include('database/akun.php');
    foreach ($akun as $a) {
        if ($a['email'] == $email) {
            $email_ada = true;
        }
    }

    // jika email belum terdaftar
    if (!$email_ada) {
        // cek password sama atau tidak
        if ($password1 == $password2) {
            $akun2 = 'akun[] = [';
            extract($_REQUEST);
            $file = fopen("database/akun.php", "a");
            fwrite($file, "$$akun2" . "\n");
            fwrite($file, '"id" => "' . time() . rand(0, 9999) . '",' . "\n");
            fwrite($file, '"nama" => "' . $_POST["nama"] . '",' . "\n");
            fwrite($file, '"email" => "' . $_POST["email"] . '",' . "\n");
            fwrite($file, '"password" => "' . $_POST["password1"] . '",' . "\n");
            fwrite($file, '"role" => "user",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
            message_alert("Registrasi berhasil silahkan login!");
            redirect_page("login");
        } else {
            $message = 'Password tidak sama!';
        }
    } else {
        $message = 'Email sudah terdaftar!';
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-11 col-lg-5 col-md-8 col-sm-10 bg-white mx-auto p-5 rounded mh-100" style="height: 800px;">
            <h1 class="text-center mb-4 mt-4">Registrasi</h1>
            <hr class="mb-4">
            <?php if ($message) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= (!$nama ? '' : $nama); ?>" placeholder="Masukkan nama lengkap anda" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= (!$email ? '' : $email); ?>" placeholder="Masukkan email anda" required>
                </div>
                <div class="mb-4">
                    <label for="password1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password1" name="password1" required>
                </div>
                <div class="mb-4">
                    <label for="password2" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
            </form>
            <hr>
            <div class="text-center">
                Sudah memiliki akun? <a href="<?= url_tujuan("login"); ?>">Login!</a>
            </div>
        </div>
        <div class="footer-login text-center rounded">
            &copy;<?= date('Y'); ?> Created By Kelompokx
        </div>
    </div>
</div>