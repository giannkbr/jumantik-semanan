<?= $this->extend('front/layout/main') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li><a href="<?= base_url() ?>#visimisi">Visi Misi</a></li>
        <li><a href="<?= base_url() ?>#staf">Kader</a></li>
        <li class="active"><a href="<?= base_url() ?>#berita">Berita</a></li>
        <li><a href="<?= base_url() ?>#gallery">Gallery</a></li>
        <li><a href="<?= base_url() ?>#footer">Contact</a></li>


    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>
<!-- ======= Cource Details Section ======= -->
<section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-8">
                <img src="<?= base_url('img/berita/' . $berita->gambar) ?>" width="100%" class="img-fluid" alt="">
                <h3><?= $berita->judul_berita ?></h3>
                <p>
                    <?= $berita->isi ?>
                </p>
            </div>
            <div class="col-lg-4">

                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Tanggal</h5>
                    <p><a href="#"> <?= date_indo($berita->tgl_berita) ?></a></p>
                </div>

                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Kategori</h5>
                    <p> <?= $berita->nama_kategori ?></p>
                </div>

                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Post By</h5>
                    <p> <?= $berita->nama ?></p>
                </div>

                <div class="text-center">
                    <h5>Bagikan Berita</h5>
                    <a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" class="btn btn-primary"><i class="mdi mdi-facebook"></i> Facebook</a>
                    <a href="http://twitter.com/share?url=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" class="btn btn-info"><i class="mdi mdi-twitter"></i> Twitter</a>
                    <a href="whatsapp://send?text=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Cource Details Section -->
<?= $this->endSection('isi') ?>