<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Tempat Kerja</a></li>
        <li class="breadcrumb-item active">List Data Tempat Kerja</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<p class="sub-title"> <button type="button" class="btn btn-primary btn-lg btn-block tambahtempatkerja"><i class=" fa fa-plus-circle"></i> Tambah Data tempat kerja</button>
</p>
<div class="viewdata"> </div>

<div class="viewmodal">
</div>


<script>
    function listtempatkerja() {
        $.ajax({
            url: "<?= site_url('tempatkerja/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listtempatkerja();
        $('.tambahtempatkerja').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('tempatkerja/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                }
            });
        });
    });
</script>
<?= $this->endSection('isi') ?>