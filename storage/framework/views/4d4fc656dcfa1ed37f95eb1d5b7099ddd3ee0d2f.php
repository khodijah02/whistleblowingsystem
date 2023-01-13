<?php $__env->startSection('content'); ?>
<section class="inner-page" style="margin-top: 100px">
    <div class="container">
        <div class="row">
            <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <p>Form Pengaduan</p>
            </header>
            
            <div class="col-xl-12 contact">
                <div id="error">
                </div>
                <form action="" method="post" id="complaint-form" class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                    <div class="row gy-4">
                        
                        <div class="form-group col-md-4 mb-2 mt-4">
                            <input id="ticket" type="hidden" name="ticket" value="<?php echo e($ticket); ?>" readonly>
                            <label for="type">Jenis Pelanggaran</label>
                            <select class="form-select py-2" name="type" id="type" style="border-radius: 0px;">
                                <option value="">-- Pilih Jenis Pelanggaran --</option>
                                <?php $__currentLoopData = $violation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($v->ID); ?>"><?php echo e($v->NAMA); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 mb-2 mt-4">
                            <label for="report_name">Nama Terlapor</label>
                            <input class="form-control" id="report_name" type="text" name="report_name">
                        </div>
                        <div class="form-group col-md-4 mb-2 mt-4">
                            <label for="date">Tanggal Perkiran Kejadian</label>
                            <input class="form-control" id="date" type="date" name="date">
                        </div>
                        <div class="form-group col-md-12 mb-2">
                            <label for="address">Lokasi Kejadian</label>
                            <input class="form-control" id="address" type="text" name="address">
                        </div>
                        <div class="form-group col-md-12 mb-2">
                            <label for="desc">Uraian Pengaduan</label>
                            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12 mb-2">
                            <label for="file">Lampiran Bukti</label>
                            <input name="file" type="file" id="file" class="form-control">
                            <small class="text-danger">Format File Yang Bisa Diupload Adalah .zip, .rar, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .jpg, .jpeg, .png, .avi, .mp4, .3gp, .mp3</small>
                        </div>

                        
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#complaint-form').submit(function (e) {
                e.preventDefault();
                var data = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "<?php echo e(route('complaint.store')); ?>",
                    data: data,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function (response) {
                        $('#submit').attr('disabled', 'disabled');
                    },
                    success: function (response) {
                        if (response.code == 400) {
                            $('#error').html('');
                            $('#error').addClass('alert alert-danger');
                            $('#error').addClass('mt-3');
                            $.each(response.message, function (key, value) {
                                $('#error').append('<span>'+value+'</span><br>');
                            });
                            $('html, body').animate({
                                scrollTop: $(".inner-page").offset().top
                            }, 50);
                        } else {
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Pengaduan Berhasil Dibuat',
                                icon: 'success',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                Swal.fire({
                                    title: 'Simpan Nomor Pengaduan Anda',
                                    text: response.ticket,
                                    icon: 'info',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then((result) => {
                                    location.reload()
                                })
                            });
                        }
                        $('#submit').removeAttr('disabled', 'disabled');
                    },
                    error: function (response) {
                        Swal.fire({
                            title: 'Ooops',
                            text: 'Ada Kesalahan',
                            icon: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            location.reload()
                        });

                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/complaint.blade.php ENDPATH**/ ?>