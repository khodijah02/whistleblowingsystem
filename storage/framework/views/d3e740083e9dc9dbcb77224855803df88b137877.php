<?php $__env->startSection('content'); ?>
<main id="main">
    <section class="inner-page" style="margin-top: 100px;">
        <div class="container">
            <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <p>Lihat Status Pengaduan</p>
            </header>
            <div class="row">
                <div class="col-lg-12 contact">
                    <form method="get" id="search_complaint" class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                        <div class="row gy-4">
                            <div class="form-group col-md-11 mb-2 mt-4">
                                <input class="form-control" id="complaint_ticket" type="text" name="complaint_ticket" placeholder="Masukan Nomor Pengaduan" required>
                            </div>
                            <div class="col-md-1 text-center">
                                <button type="submit" id="search_complaint_button">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12 mt-5 text-center" id="search_result">

                </div>
            </div>
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('assets/js/script-landing.js')); ?>"></script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/user/complaint/show.blade.php ENDPATH**/ ?>