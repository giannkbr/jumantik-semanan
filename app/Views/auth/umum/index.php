<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Umum</a></li>
        <li class="breadcrumb-item active">List Data Umum</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<p class="sub-title"> <button type="button" class="btn btn-primary btn-lg btn-block tambahumum"><i class=" fa fa-plus-circle"></i> Tambah Data Tempat Umum</button>
</p>
<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listumum() {
        $.ajax({
            url: "<?= site_url('umum/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listumum();
        $('.tambahumum').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('umum/formtambah') ?>",
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