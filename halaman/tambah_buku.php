<?php
// variabel kosong
$isbn = "";
$judul_buku = "";
$penulis_buku = "";
$penerbit_buku = "";
$tahun_terbit = "";
$halaman = "";
$deskripsi = "";
$stok_buku = "";

if (isset($_POST["tambah-buku"])) {
    // untuk mengisi value pada input jika gagal disimpan
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $penulis_buku = $_POST['penulis_buku'];
    $penerbit_buku = $_POST['penerbit_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $halaman = $_POST['halaman'];
    $deskripsi = $_POST['deskripsi'];
    $stok_buku = $_POST['stok_buku'];


    function insert_buku()
    {
        $gambar2 = upload();
        if (!$gambar2) {
            return false;
        }

        $buku = 'buku[] = [';
        //Fungsi extract() mengimpor variabel ke dalam tabel simbol lokal dari sebuah array.
        extract($_REQUEST);
        $file = fopen("database/buku.php", "a");
        fwrite($file, "$$buku" . "\n");
        fwrite($file, '"id" => "' . time() . rand(0, 999) . '",' . "\n");
        fwrite($file, '"isbn" => "' . $_POST["isbn"] . '",' . "\n");
        fwrite($file, '"judul_buku" => "' . $_POST["judul_buku"] . '",' . "\n");
        fwrite($file, '"penulis_buku" => "' . $_POST["penulis_buku"] . '",' . "\n");
        fwrite($file, '"penerbit_buku" => "' . $_POST["penerbit_buku"] . '",' . "\n");
        fwrite($file, '"tahun_terbit" => "' . $_POST["tahun_terbit"] . '",' . "\n");
        fwrite($file, '"halaman" => "' . $_POST["halaman"] . '",' . "\n");
        fwrite($file, '"deskripsi" => "' . $_POST["deskripsi"] . '",' . "\n");
        fwrite($file, '"stok_buku" => "' . $_POST["stok_buku"] . '",' . "\n");
        fwrite($file, '"gambar" => "' . $gambar2 . '",' . "\n");
        fwrite($file, '];' . "\n");
        fclose($file);
        return true;
    }

    function redirect_home()
    {
        message_alert("Data berhasil disimpan!");
        redirect_page("home");
    }

    if (insert_buku()) {
        redirect_home();
    }
}
?>

<!-- form -->
<div class="container pt-3 pb-4">
    <div class="col-lg-8 col-md-10 mx-auto">
        <a href="<?= url_tujuan("home"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left pe-1"></i>Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card mx-auto">
                <h5 class="card-header">Form Tambah Buku</h5>
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="number" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN" value="<?= $isbn; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul buku</label>
                            <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku" value="<?= $judul_buku; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis_buku" class="form-label">Penulis buku</label>
                            <input type="text" class="form-control" id="penulis_buku" name="penulis_buku" placeholder="Masukkan penulis buku" value="<?= $penulis_buku; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit_buku" class="form-label">Penerbit buku</label>
                            <input type="text" class="form-control" id="penerbit_buku" name="penerbit_buku" placeholder="Masukkan penerbit buku" value="<?= $penerbit_buku; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                            <select class="form-select" id="tahun_terbit" name="tahun_terbit" required>
                                <option selected disabled value="">Pilih tahun terbit</option>
                                <?php $year_now = date('Y'); ?>
                                <?php for ($i = $year_now; $i > 1800; $i--) : ?>
                                    <option value="<?= $i; ?>" <?= ($i == $tahun_terbit ? 'selected' : ''); ?>><?= $i; ?></option>";
                                <?php endfor; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="halaman" class="form-label">Halaman</label>
                            <input type="number" class="form-control" id="halaman" name="halaman" placeholder="Masukkan jumlah halaman" value="<?= $halaman; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi buku</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $deskripsi; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="stok_buku" class="form-label">Stok buku</label>
                            <input type="number" class="form-control" id="stok_buku" name="stok_buku" placeholder="Masukkan stok buku" value="<?= $stok_buku; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                        </div>
                        <button type="submit" name="tambah-buku" class="btn btn-primary mt-3">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>