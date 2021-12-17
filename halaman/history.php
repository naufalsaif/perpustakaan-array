<?php
// variabel kosong
$pinjam = [];
?>
<div class="container my-3">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                    <?php if ($_SESSION['role'] == "admin") : ?>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Buku</th>
                                <th>Tanggal pinjam</th>
                                <th>Tanggal kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            include('database/pinjam.php');
                            $jumlah_array = count($pinjam) - 1;
                            $no_index = $jumlah_array;
                            $pinjam_reverse = array_reverse($pinjam);
                            ?>
                            <?php foreach ($pinjam_reverse as $p) : ?>
                                <tr>
                                    <th><?= $no++; ?></th>
                                    <td><?= $p['email']; ?></td>
                                    <td><?= $p['judul_buku']; ?></td>
                                    <td><?= date('d-M-Y, H:i:s', $p['tanggal_pinjam']); ?></td>
                                    <td><?= (!$p['tanggal_kembali'] ? '-' : date('d-M-Y, H:i:s', $p['tanggal_kembali'])); ?></td>
                                    <td><?= (!$p['tanggal_kembali'] ? '<h1 class="h6 badge rounded-pill bg-danger">Masih dipinjam</h1>' : '<h1 class="h6 badge rounded-pill bg-success">Sudah dikembalikan</h1>'); ?></td>
                                    <td>
                                        <?php if (!$p['tanggal_kembali']) :  ?>
                                            <form action="<?= url_tujuan("kembali_buku&no_index=" . $no_index); ?>" method="post">
                                                <button type="submit" class="btn btn-success" onclick='return confirm("Anda sudah selesai memakainya?")' style="font-size: 12px;">Kembalikan</button>
                                            </form>
                                        <?php else : ?>
                                            <h1 class="d-inline-block btn-sm btn-primary shadow-sm">Selesai</h1>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $no_index-- ?>
                            <?php endforeach; ?>
                        </tbody>


                    <?php else : ?>

                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Buku</th>
                                <th>Tanggal pinjam</th>
                                <th>Tanggal kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            include('database/pinjam.php');
                            $jumlah_array = count($pinjam) - 1;
                            $no_index = $jumlah_array;
                            $pinjam_reverse = array_reverse($pinjam);

                            include('database/akun.php');
                            $no_index = $_SESSION['id_akun'];
                            $data_akun = $akun[$no_index];
                            ?>
                            <?php foreach ($pinjam_reverse as $p) : ?>
                                <tr>
                                    <?php if ($p['email'] == $data_akun['email']) : ?>
                                        <td><?= $p['email']; ?></td>
                                        <td><?= $p['judul_buku']; ?></td>
                                        <td><?= date('d-M-Y, H:i:s', $p['tanggal_pinjam']); ?></td>
                                        <td><?= (!$p['tanggal_kembali'] ? '-' : date('d-M-Y, H:i:s', $p['tanggal_kembali'])); ?></td>
                                        <td><?= (!$p['tanggal_kembali'] ? '<h1 class="h6 badge rounded-pill bg-danger">Masih dipinjam</h1>' : '<h1 class="h6 badge rounded-pill bg-success">Sudah dikembalikan</h1>'); ?></td>
                                        <td>
                                            <?php if (!$p['tanggal_kembali']) :  ?>
                                                <form action="<?= url_tujuan("kembali_buku&no_index=" . $no_index); ?>" method="post">
                                                    <button type="submit" class="btn btn-success" onclick='return confirm("Anda sudah selesai memakainya?")' style="font-size: 12px;">Kembalikan</button>
                                                </form>
                                            <?php else : ?>
                                                <h1 class="d-inline-block btn-sm btn-primary shadow-sm">Selesai</h1>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $no_index--; ?>
                            <?php endforeach; ?>
                        </tbody>

                    <?php endif; ?>

                </table>
            </div>
        </div>
    </div>
</div>
<?php if (!$pinjam) :  ?>
    <div class="container">
        <div class="row">
            <div class="alert alert-danger alert-dismissible fade show my-3 mx-2" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                Data pinjam belum tersedia!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>