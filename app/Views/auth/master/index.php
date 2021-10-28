<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Tempat master</a></li>
        <li class="breadcrumb-item active">List Data Tempat master</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<!-- <p class="sub-title">
    <input type="date" name="tanggal" class="form-control">
    <button type="button" class="mt-2 btn btn-primary btn-lg btn-block"><i class=" fa fa-plus-circle"></i> Filter Data</button>
</p> -->
<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listmaster() {
        $.ajax({
            url: "<?= site_url('master/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listmaster();
        $('.tambahmaster').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('master/formtambah') ?>",
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