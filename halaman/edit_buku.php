<?php
// variabel kosong
$buku = [];
$isbn = "";
$judul_buku = "";
$penulis_buku = "";
$penerbit_buku = "";
$tahun_terbit = "";
$halaman = "";
$deskripsi = "";
$stok_buku = "";

// edit buku
if (isset($_POST["edit-buku"])) {
    // untuk mengisi value pada input jika gagal disimpan
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $penulis_buku = $_POST['penulis_buku'];
    $penerbit_buku = $_POST['penerbit_buku'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $halaman = $_POST['halaman'];
    $deskripsi = $_POST['deskripsi'];
    $stok_buku = $_POST['stok_buku'];


    // masukkan data edit 
    function edit_data()
    {
        $gambarlama = $_POST['gambarlama'];
        // cek apakah user pilih gambar baru atau tidak
        if ($_FILES['gambar']['error'] === 4) {
            $gambar2 = $gambarlama;
        } else {
            $gambar2 = upload_edit($gambarlama);
            if (!$gambar2) {
                $GLOBALS['upload_error_message'] = true;
                return false;
            }
        }

        $no_index = $_GET['no_index'];
        $buku = "buku[$no_index] = [";
        extract($_REQUEST);
        $file = fopen("database/buku.php", "a");
        fwrite($file, "$$buku" . "\n");
        fwrite($file, '"id" => "' . $_POST["id"] . '",' . "\n");
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
    // membuat file temp
    function newfile_temp()
    {
        if (!file_exists('database/temp.php')) {
            fopen('database/temp.php', 'w');
        } else {
            echo 'File sudah ada';
        }
    }

    // // masukkan data ke file temp
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

    // // masukkan data ke file database_buku
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

    if (edit_data()) {
        newfile_temp();
        insert_temp();
        delete_database_buku();
        newfile_database_buku();
        insert_database_buku();
        delete_temp();


        // redirect home
        message_alert("Data berhasil diedit!");
        redirect_page("home");
    }
}

// ngambil data buku
include('database/buku.php');
$no_index = $_GET['no_index'];
$data_buku = $buku[$no_index];
?>
<!-- form -->
<div class="container pt-3 pb-4">
    <div class="col-lg-8 col-md-10 mx-auto">
        <a href="<?= url_tujuan("home"); ?>" class="btn btn-primary mb-3"><i class="fas fa-arrow-left pe-1"></i>Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <h5 class="card-header">Form Edit Buku</h5>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data_buku['id']; ?>">
                        <input type="hidden" name="gambarlama" value="<?= $data_buku['gambar']; ?>">
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <?php if (!$isbn) : ?>
                                <input type="number" class="form-control" id="isbn" name="isbn" value="<?= $data_buku['isbn']; ?>" required>
                            <?php else : ?>
                                <input type="number" class="form-control" id="isbn" name="isbn" value="<?= $isbn; ?>" required>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul buku</label>
                            <?php if (!$judul_buku) : ?>
                                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= $data_buku['judul_buku']; ?>" required>
                            <?php else : ?>
                                <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= $judul_buku; ?>" required>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="penulis_buku" class="form-label">Penulis buku</label>
                            <?php if (!$penulis_buku) : ?>
                                <input type="text" class="form-control" id="penulis_buku" name="penulis_buku" value="<?= $data_buku['penulis_buku']; ?>" required>
                            <?php else : ?>
                                <input type="text" class="form-control" id="penulis_buku" name="penulis_buku" value="<?= $penulis_buku; ?>" required>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit_buku" class="form-label">Penerbit buku</label>
                            <?php if (!$penerbit_buku) : ?>
                                <input type="text" class="form-control" id="penerbit_buku" name="penerbit_buku" value="<?= $data_buku['penerbit_buku']; ?>" required>
                            <?php else : ?>
                                <input type="text" class="form-control" id="penerbit_buku" name="penerbit_buku" value="<?= $penerbit_buku; ?>" required>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun terbit</label>
                            <select class="form-select" id="tahun_terbit" name="tahun_terbit" required>
                                <option disabled value="">Pilih tahun terbit</option>
                                <?php $year_now = date('Y'); ?>
                                <?php for ($i = $year_now; $i > 1800; $i--) : ?>
                                    <?php if (!$tahun_terbit) : ?>
                                        <option value="<?= $i; ?>" <?= ($data_buku['tahun_terbit'] == $i ? 'selected' : ''); ?>><?= $i; ?></option>";
                                    <?php else : ?>
                                        <option value="<?= $i; ?>" <?= ($tahun_terbit == $i ? 'selected' : ''); ?>><?= $i; ?></option>";
                                    <?php endif; ?>
                                <?php endfor; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="halaman" class="form-label">Halaman</label>
                            <?php if (!$halaman) : ?>
                                <input type="number" class="form-control" id="halaman" name="halaman" value="<?= $data_buku['halaman']; ?>" required>
                            <?php else : ?>
                                <input type="number" class="form-control" id="halaman" name="halaman" value="<?= $halaman; ?>" required>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi buku</label>
                            <?php if (!$deskripsi) : ?>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $data_buku['deskripsi']; ?></textarea>
                            <?php else : ?>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $deskripsi; ?></textarea>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="stok_buku" class="form-label">Stok buku</label>
                            <?php if (!$stok_buku) : ?>
                                <input type="number" class="form-control" id="stok_buku" name="stok_buku" value="<?= $data_buku['stok_buku']; ?>" required>
                            <?php else : ?>
                                <input type="number" class="form-control" id="stok_buku" name="stok_buku" value="<?= $stok_buku; ?>" required>
                            <?php endif; ?>

                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label><br>
                            <img src="img/buku/<?= $data_buku['gambar']; ?>" alt="" style="width: 100px;">
                            <input class="form-control mt-3" type="file" id="gambar" name="gambar">
                        </div>
                        <button type="submit" name="edit-buku" class="btn btn-primary my-3">Simpan</button>
                        <?php
                        $data_ada = "";
                        $pinjam = [];
                        include('database/pinjam.php');
                        foreach ($pinjam as $p) {
                            if ($p["id_buku"] == $data_buku["id"]) {
                                $data_ada = true;
                            }
                        }
                        ?>
                        <?php if (!$data_ada) : ?>
                            <a href="<?= url_tujuan("hapus_buku&no_index=" . $no_index); ?>" class="btn btn-danger float-end my-3" onclick="return confirm('Yakin ingin menghapus data?')">Hapus data</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>