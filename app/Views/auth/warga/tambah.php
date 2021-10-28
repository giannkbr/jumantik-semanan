<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('warga/simpanwarga', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Rukun Tetangga</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_warga" name="nama_warga">
                        <div class="invalid-feedback errorNamaWarga">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Rukun Warga</label>
                    <div class="col-sm-8">
                        <select name="tetangga_id" id="tetangga_id" class="js-example-basic-single">
                            <option Disabled=true Selected=true> </option>
                            <?php foreach ($tetangga as $key => $data) { ?>
                                <option value="<?= $data['tetangga_id'] ?>"><?= $data['nama_tetangga'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorTetangga">

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nama_warga: $('input#nama_warga').val(),
                    tetangga_id: $('select#tetangga_id').val(),
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                    
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNamaWarga').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNamaWarga').html('');
                        }

                        if (response.error.tetangga_id) {
                            $('#tetangga_id').addClass('is-invalid');
                            $('.errorTetangga').html(response.error.tetangga_id);
                        } else {
                            $('#tetangga_id').removeClass('is-invalid');
                            $('.errorTetangga').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaltambah').modal('hide');
                        listwarga();
                    }
                }
            });
        })
    });
</script>