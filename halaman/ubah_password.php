<?php
$message = "";
$password = "";
$password1 = "";
$password2 = "";


if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];



    // edit data akun
    function edit_akun()
    {
        include('database/akun.php');
        $no_index = $_SESSION['id_akun'];
        $akun2 = "akun[$no_index] = [";
        $data_akun = $akun[$no_index];

        extract($_REQUEST);
        $file = fopen("database/akun.php", "a");
        fwrite($file, "$$akun2" . "\n");
        fwrite($file, '"id" => "' . $data_akun['id'] . '",' . "\n");
        fwrite($file, '"nama" => "' . $data_akun['nama'] . '",' . "\n");
        fwrite($file, '"email" => "' . $data_akun['email'] . '",' . "\n");
        fwrite($file, '"password" => "' . $_POST['password1'] . '",' . "\n");
        fwrite($file, '"role" => "' . $data_akun['role'] . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
    }

    // membuat file temp
    function newfile_temp_akun()
    {
        if (!file_exists('database/temp.php')) {
            fopen('database/temp.php', 'w');
        } else {
            echo 'File sudah ada';
        }
    }

    // masukkan data ke file temp
    function insert_temp_akun()
    {
        include('database/akun.php');
        $akun2 = 'akun[] = [';
        $file = fopen("database/temp.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        foreach ($akun as $a) {
            $file = fopen("database/temp.php", "a");
            fwrite($file, "$$akun2" . "\n");
            fwrite($file, '"id" => "' . $a["id"] . '",' . "\n");
            fwrite($file, '"nama" => "' . $a["nama"] . '",' . "\n");
            fwrite($file, '"email" => "' . $a["email"] . '",' . "\n");
            fwrite($file, '"password" => "' . $a["password"] . '",' . "\n");
            fwrite($file, '"role" => "' . $a["role"] . '",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
        }
    }

    // hapus file database_akun
    function delete_database_akun()
    {
        $file_database_akun = 'database/akun.php';
        if (file_exists($file_database_akun)) {
            unlink($file_database_akun);
            'File berhasil di hapus';
        } else {
            'File tidak ditemukan';
        }
    }

    // buat file database_akun
    function newfile_database_akun()
    {
        if (!file_exists('database/akun.php')) {
            fopen('database/akun.php', 'w');
        } else {
            'File sudah ada';
        }
    }

    // masukkan data ke file database_akun
    function insert_database_akun()
    {
        include('database/temp.php');
        $akun2 = 'akun[] = [';
        $file = fopen("database/akun.php", "a");
        fwrite($file, "<?php" . "\n");
        fclose($file);
        foreach ($akun as $a) {
            $file = fopen("database/akun.php", "a");
            fwrite($file, "$$akun2" . "\n");
            fwrite($file, '"id" => "' . $a["id"] . '",' . "\n");
            fwrite($file, '"nama" => "' . $a["nama"] . '",' . "\n");
            fwrite($file, '"email" => "' . $a["email"] . '",' . "\n");
            fwrite($file, '"password" => "' . $a["password"] . '",' . "\n");
            fwrite($file, '"role" => "' . $a["role"] . '",' . "\n");
            fwrite($file, '];' . "\n");
            fclose($file);
        }
    }

    // hapus file temp
    function delete_temp_akun()
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
    function redirect_login()
    {
        message_alert("Anda berhasil mengubah password!");
        logout();
    }

    // cek password
    include('database/akun.php');
    $no_index = $_SESSION['id_akun'];
    $data_akun = $akun[$no_index];
    if ($data_akun['password'] == $_POST['password']) {
        if ($_POST['password1'] == $_POST['password2']) {
            // run function
            edit_akun();
            newfile_temp_akun();
            insert_temp_akun();
            delete_database_akun();
            newfile_database_akun();
            insert_database_akun();
            delete_temp_akun();
            redirect_login();
        } else {
            $message = "password baru berbeda!";
        }
    } else {
        $message = "Password yang anda masukkan salah!";
    }
}
?>
<div class="container py-3">
    <div class="col-lg-8 col-md-10 mx-auto">
        <a href="<?= url_tujuan("akun"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left pe-1"></i>Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <h4 class="card-header"><i class="fas fa-cog"></i> Ubah Password</h4>
                <div class="card-body">
                    <?php if ($message) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password lama</label>
                            <input type="password" class="form-control" id="password" name="password" required value="<?= (!$password ? '' : $password); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password baru</label>
                            <input type="password" class="form-control" id="password1" name="password1" required value="<?= (!$password1 ? '' : $password1); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi password baru</label>
                            <input type="password" class="form-control" id="password2" name="password2" required value="<?= (!$password2 ? '' : $password2); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>