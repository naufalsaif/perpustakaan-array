<?php
include "functions.php";
if (isset($_SESSION["session_login"])) {
    redirect_page("home");
}

$email = "";
$message = "";

// cek akun ada atau tidak
if (isset($_POST['submit'])) {
    $email_ada = "";
    $akun = [];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no = 0;
    include "database/akun.php";
    foreach ($akun as $a) {
        if ($a['email'] == $email) {
            $email_ada = true;
            $no_index_akun = $no;
        }
        $no++;
    }


    // cek email ada atau tidak
    if ($email_ada) {
        $data_akun = $akun[$no_index_akun];
        // cek password
        if ($data_akun['password'] == $password) {
            $_SESSION["session_login"] = true;
            $_SESSION["id_akun"] = $no_index_akun;
            $_SESSION["role"] = $data_akun['role'];
            redirect_page("home");
        } else {
            $message = "Password yang anda masukkan salah!";
        }
    } else {
        $message = "Email tidak ditemukan!";
    }
}

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-11 col-lg-5 col-md-8 col-sm-10 bg-white mx-auto p-5 rounded mh-100" style="height: 600px;">
            <h1 class="text-center mb-4 mt-4">LOGIN</h1>
            <hr class="mb-4">
            <?php if ($message) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= (!$email ? '' : $email); ?>" placeholder="Masukkan email anda" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </form>
            <hr>
            <div class="text-center">
                Belum memiliki akun? <a href="<?= url_tujuan("registrasi"); ?>">Registrasi</a>
            </div>
        </div>
        <div class="footer-login text-center rounded">
            &copy;<?= date('Y'); ?> Created By Kelompok 5
        </div>
    </div>
</div>