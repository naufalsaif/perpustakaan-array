<?php
include "functions.php";
if (!isset($_SESSION["session_login"])) {
    redirect_page("login");
}
if (isset($_POST['logout'])) {
    logout();
}
$page = $_GET['page'];
?>
<!-- As a heading -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= url_tujuan("home"); ?>"><strong><i class="fas fa-fw fa-book-reader"></i> IDBOOK</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link <?= ($page == 'home' ? 'active' : ''); ?>" aria-current="page" href="<?= url_tujuan("home"); ?>"><i class="fas fa-fw fa-home"></i> Home</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link <?= ($page == 'history' ? 'active' : ''); ?>" href="<?= url_tujuan("history"); ?>"><i class="fas fa-fw fa-history"></i> History</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link <?= ($page == 'akun' ? 'active' : ''); ?>" href="<?= url_tujuan("akun"); ?>"><i class="fas fa-fw fa-user"></i> Akun</a>
                </li>
                <li class="nav-item ms-3">
                    <form action="" method="POST">
                        <button type="submit" class="nav-link btn btn-danger text-white" name="logout" onclick='return confirm("Yakin ingin keluar")'><i class="fas fa-fw fa-sign-out-alt"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>