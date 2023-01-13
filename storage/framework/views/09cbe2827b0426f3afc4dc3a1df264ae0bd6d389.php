<?php $__env->startSection('content'); ?>
<section class="inner-page" style="margin-top: 100px;">
    <div class="container">
        <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <p>Lihat Status Pengaduan</p>
        </header>
        <div class="row">
            <div class="col-lg-12 contact">
                <div id="error">
                </div>
                <form method="get" id="complaint_form" class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                    <div class="row gy-4">
                        <div class="form-group col-md-11 mb-2 mt-4">
                            <input class="form-control" id="complaint_ticket" type="text" name="complaint_ticket" placeholder="Masukan Nomor Pengaduan">
                        </div>
                        <div class="col-md-1 text-center">
                            <button class="btn btn-primary" type="submit" id="search_submit_button">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12 mt-5 text-center" id="search_result">

            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
    <script>
        $(document).ready(function () {
            $('#complaint_form').submit(function (e) {
                e.preventDefault();
                var complaint = $('#complaint_ticket').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "<?php echo e(route('complaint.search')); ?>",
                    data: {complaint:complaint},
                    dataType: "json",
                    beforeSend: function (response) {
                        $('#search_submit_button').attr('disabled', 'disabled');
                    },
                    success: function (response) {
                        $('#search_result').html('');
                        $('#search_result').html(response.complaint);
                        $('#search_submit_button').removeAttr('disabled');
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





<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wbs\resources\views/user/complaint/show.blade.php ENDPATH**/ ?>