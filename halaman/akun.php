<?php
include('database/akun.php');
$data_akun_ini = $akun[$_SESSION['id_akun']];
?>

<div class="container py-3">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <h4 class="card-header"><i class="fas fa-cog"></i> Pengaturan Akun</h4>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nama:</strong> <span class="text-primary"><?= $data_akun_ini['nama']; ?></span><a href="<?= url_tujuan("ubah_nama"); ?>" class="float-end">Ubah&rarr;</a></li>
                        <li class="list-group-item"><strong>Email:</strong> <span class="text-primary"><?= $data_akun_ini['email']; ?></span><a href="<?= url_tujuan("ubah_email"); ?>" class="float-end">Ubah&rarr;</a></li>
                        <li class="list-group-item"><strong>Password:</strong> <span class="text-primary">*****</span><a href="<?= url_tujuan("ubah_password"); ?>" class="float-end">Ubah&rarr;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>