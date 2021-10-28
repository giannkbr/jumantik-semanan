<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('tempatkerja/update', ['class' => 'formtempatkerja']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="tempatkerja_id" value="<?= $tempatkerja_id ?>" name="tempatkerja_id" readonly>

                    <label for="" class="col-sm-4 col-form-label">Nama Tempat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_tempat" value="<?= $nama_tempat ?>" name="nama_tempat">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat tempat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="alamat_tempat"  value="<?= $alamat_tempat ?>" name="alamat_tempat">
                        <div class="invalid-feedback errorAlamat">

                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Periksa</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tanggal" value="<?= $tanggal ?>" name="tanggal" >
                        <div class="invalid-feedback errorTanggal">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Dispenser</label>
                    <div class="col-sm-8">
                        <select name="dispenser" id="dispenser" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="0" <?php if ($dispenser == '0') echo "selected"; ?>>0</option>
                            <option value="1" <?php if ($dispenser == '1') echo "selected"; ?>>1</option>
                        </select>
                        <div class="invalid-feedback errordispenser">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Bak Mandi</label>
                    <div class="col-sm-8">
                        <select name="bak_mandi" id="bak_mandi" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="0" <?php if ($bak_mandi == '0') echo "selected"; ?>>0</option>
                            <option value="1" <?php if ($bak_mandi == '1') echo "selected"; ?>>1</option>
                        </select>
                        <div class="invalid-feedback errorBakMandi">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Kolam Ikan</label>
                    <div class="col-sm-8">
                        <select name="kolam_ikan" id="kolam_ikan" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="0" <?php if ($kolam_ikan == '0') echo "selected"; ?>>0</option>
                            <option value="1" <?php if ($kolam_ikan == '1') echo "selected"; ?>>1</option>
                        </select>
                        <div class="invalid-feedback errorKolamIkan">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Cucian Piring</label>
                    <div class="col-sm-8">
                        <select name="cucian_piring" id="cucian_piring" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="0" <?php if ($cucian_piring == '0') echo "selected"; ?>>0</option>
                            <option value="1" <?php if ($cucian_piring == '1') echo "selected"; ?>>1</option>
                        </select>
                        <div class="invalid-feedback errorCucian">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Pot Tanaman</label>
                    <div class="col-sm-8">
                        <select name="pot_tanaman" id="pot_tanaman" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="0" <?php if ($pot_tanaman == '0') echo "selected"; ?>>0</option>
                            <option value="1" <?php if ($pot_tanaman == '1') echo "selected"; ?>>1</option>
                        </select>
                        <div class="invalid-feedback errorPotTanaman">

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
        $('.formtempatkerja').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                            $('#nama_tempat').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama_tempat').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat_tempat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            $('#alamat_tempat').removeClass('is-invalid');
                            $('.errorAlamat').html('');
                        }


                        if (response.error.tanggal) {
                            $('#tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('#tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }

                        if (response.error.dispenser) {
                            $('#dispenser').addClass('is-invalid');
                            $('.errordispenser').html(response.error.dispenser);
                        } else {
                            $('#dispenser').removeClass('is-invalid');
                            $('.errordispenser').html('');
                        }

                        if (response.error.bak_mandi) {
                            $('#bak_mandi').addClass('is-invalid');
                            $('.errorBakMandi').html(response.error.dispenser);
                        } else {
                            $('#bak_mandi').removeClass('is-invalid');
                            $('.errorBakMandi').html('');
                        }

                        if (response.error.kolam_ikan) {
                            $('#kolam_ikan').addClass('is-invalid');
                            $('.errorKolamIkan').html(response.error.dispenser);
                        } else {
                            $('#kolam_ikan').removeClass('is-invalid');
                            $('.errorKolamIkan').html('');
                        }

                        
                        if (response.error.cucian) {
                            $('#cucian_piring').addClass('is-invalid');
                            $('.errorCucian').html(response.error.dispenser);
                        } else {
                            $('#cucian_piring').removeClass('is-invalid');
                            $('.errorCucian').html('');
                        }

                          
                        if (response.error.pot_tanaman) {
                            $('#pot_tanaman').addClass('is-invalid');
                            $('.errorPotTanaman').html(response.error.dispenser);
                        } else {
                            $('#pot_tanaman').removeClass('is-invalid');
                            $('.errorPotTanaman').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaledit').modal('hide');
                        listtempatkerja();
                    }
                }
            });
        })
    });
</script>