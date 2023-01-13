<?php $__env->startSection('content'); ?>
<section class="inner-page" style="margin-top: 100px">
    <div class="container">
        <div class="row">
            <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <p>Form Pengaduan</p>
            </header>
            
            <div class="col-xl-12 contact">
                <div id="error_message">
                </div>
                <form action="" method="post" id="complaint_form" class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                    <div class="row gy-4">
                        
                        <div class="form-group col-md-4 mb-2 mt-4">
                            <input id="ticket" type="hidden" name="complaint_ticket" value="<?php echo e($complaintTicket); ?>" readonly>
                            <label for="violation_type">Jenis Pelanggaran</label>
                            <select class="form-select py-2" name="violation_type" id="violation_type" style="border-radius: 0px;">
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
                            <small class="text-danger">File Lampiran Bukti Maksimal 10 mb</small><br>
                            <small class="text-danger">Format File Yang Bisa Diupload Adalah .zip, .rar, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .jpg, .jpeg, .png, .avi, .mp4, .3gp, .mp3</small>
                        </div>

                        
                    </div>
                    <button class="btn btn-primary mt-3" type="submit" id="complaint_submit_button">Submit</button>
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
            $('#complaint_form').submit(function (e) {
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
                        $('#complaint_submit_button').attr('disabled', 'disabled');
                    },
                    success: function (response) {
                        if (response.code == 400) {
                            $('#error_message').html('');
                            $('#error_message').addClass('alert alert-danger');
                            $('#error_message').addClass('mt-3');
                            $.each(response.message, function (key, value) {
                                $('#error_message').append('<span>'+value+'</span><br>');
                            });
                            $('html, body').animate({
                                scrollTop: $(".inner-page").offset().top
                            }, 50);
                        } else {
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Terimakasih Telah Melakukan Laporan',
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
                        $('#complaint_submit_button').removeAttr('disabled', 'disabled');
                    },
                    error: function (response) {
                        Swal.fire({
                            title: 'Ooops',
                            text: 'Ada Kesalahan, Silahkan hubungi SIMRS',
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





<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wbs\resources\views/user/complaint/create.blade.php ENDPATH**/ ?>