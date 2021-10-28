<?= $this->extend('layout/main') ?>
<?= $this->section('nav') ?>
<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <!-- full screen -->
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                <i class="mdi mdi-arrow-expand-all noti-icon"></i>
            </a>
        </li>

        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('img/user/' .  session()->get('foto')) ?>" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item" href="javascript:void(0);"> <?= session()->get('nama') ?> </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>

</nav>
<?= $this->endSection('nav') ?>


<?= $this->section('menu') ?>
<li class="menu-title">Dashboard</li>
<li>
    <a href="<?= base_url('auth/dashboard') ?>" class="waves-effect">
        <i class="icon-accelerator"></i> <span> Dashboard </span>
    </a>
</li>

<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">Master Data</li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-group"></i> <span>Data Rt dan Rw <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="<?= base_url('auth/warga/tetangga') ?>">Rukun Warga</a></li>
            <li><a href="<?= base_url('auth/warga') ?>">Rukun Tetangga</a></li>
        </ul>
    </li>
    <li>
        <a href="<?= base_url('auth/staf') ?>" class="waves-effect">
            <i class="mdi mdi-account-switch"></i> <span> Data Kader </span>
        </a>
    </li>
<?php } ?>
    <li>
        <a href="<?= base_url('auth/master') ?>" class="waves-effect">
            <i class="mdi mdi-equal-box"></i> <span> Master Data Jumantik </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-table-large"></i> <span> Data Jumantik <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">

            <li><a href="<?= base_url('auth/pendidikan') ?>">Sarana Pendidikan</a></li>
            <li><a href="<?= base_url('auth/umum') ?>">Tempat Umum</a></li>
            <li><a href="<?= base_url('auth/olahraga') ?>">Sarana Olahraga</a></li>
            <li><a href="<?= base_url('auth/kesehatan') ?>">Sarana Kesehatan</a></li>
            <li><a href="<?= base_url('auth/makanan') ?>">Tempat Jual Makanan</a></li>
            <li><a href="<?= base_url('auth/rumahtangga') ?>">Rumah Tangga</a></li>
             <li><a href="<?= base_url('auth/tempatkerja') ?>">Tempat Kerja/ Kantor</a></li>
        </ul>
    </li>
   
<?php if (session()->get('level') == 2 || session()->get('level') == 1 ) { ?>
    <li class="menu-title">DATA WEBSITE</li>
    <li>
        <a href="<?= base_url('auth/gallery') ?>" class="waves-effect">
            <i class="mdi mdi-album"></i> <span> Gallery </span>
        </a>
    </li>
    <li>
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-blogger"></i> <span>Berita<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
        <ul class="submenu">
            <li><a href="<?= base_url('/auth/berita') ?>">Tulis Berita</a></li>
            <li><a href="<?= base_url('/auth/berita/kategori') ?>">Kategori</a></li>
        </ul>
    </li>
<?php } ?>

<?php if (session()->get('level') == 2) { ?>
    <li class="menu-title">SETTINGS</li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/user') ?>" class="waves-effect">
            <i class="mdi mdi-account-switch"></i> <span> Konfigurasi User </span>
        </a>
    </li>
    <li>
        <a href="<?= base_url('auth/konfigurasi/web') ?>" class="waves-effect">
            <i class="mdi mdi-settings-outline"></i> <span> Konfigurasi Web </span>
        </a>
    </li>
<?php } ?>
<?= $this->endSection('menu') ?>