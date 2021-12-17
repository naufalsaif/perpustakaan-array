<?php
// ngambil data array di file database_buku
include('database/buku.php');
$no_index = $_GET['no_index'];
$data_buku = $buku[$no_index];
?>

<!-- detail -->
<div class="container mt-3 mb-4">
    <div class="col">
        <a href="<?= url_tujuan("home"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left pe-1"></i>Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <img src="img/buku/<?= $data_buku['gambar']; ?>" alt="gambar-buku" class="img-fluid mb-3">
        </div>
        <div class="col-lg-9">
            <h2 class="mb-4">Detail buku</h2>
            <p class="paragraf-buku"><strong>ISBN</strong>: <?= $data_buku['isbn']; ?></p>
            <p class="paragraf-buku"><strong>Judul buku</strong>: <?= $data_buku['judul_buku']; ?></p>
            <p class="paragraf-buku"><strong>Penulis buku</strong>: <?= $data_buku['penulis_buku']; ?></p>
            <p class="paragraf-buku"><strong>Penerbit buku</strong>: <?= $data_buku['penerbit_buku']; ?></p>
            <p class="paragraf-buku"><strong>Tahun terbit</strong>: <?= $data_buku['tahun_terbit']; ?></p>
            <p class="paragraf-buku"><strong>Halaman</strong>: <?= $data_buku['halaman']; ?> halaman</p>
            <p class="paragraf-buku" style="text-align: justify;"><strong>Deskripsi</strong>: <?= $data_buku['deskripsi']; ?></p>
            <p class="paragraf-buku"><strong>Stok buku</strong>: <?= $data_buku['stok_buku']; ?></p>
            <?php if ($data_buku['stok_buku'] == "0") : ?>
                <h1 class="d-inline-block btn-sm btn-danger shadow-sm mt-3">Stok buku habis, mohon tunggu orang lain mengembalikan!</h1>
            <?php else : ?>
                <form action="<?= url_tujuan("pinjam_buku&no_index=" . $no_index); ?>" method="post">
                    <button class="btn btn-success mt-3" onclick='return confirm("Anda ingin meminjam buku?")'>Pinjam buku</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>