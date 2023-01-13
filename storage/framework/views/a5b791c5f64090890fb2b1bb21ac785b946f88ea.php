<?php $__env->startSection('content'); ?>
<section class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom">Selamat Datang Di Whistleblowing System RSUD Kota Bogor</h1>
                <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</p>
                <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                    <div class="text-center text-lg-start">
                        <a class="btn btn-lg btn-outline-primary mt-3" href="<?php echo e(route('complaint.index')); ?>">Buat Pengaduan</a>
                        <a class="btn btn-lg btn-outline-primary mt-3" href="">Lihat Pengaduan Saya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out">
                <img src="<?php echo e(asset('assets/images/landing/hero-img.png')); ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

<main id="main">
    <section class="about">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <div class="content">
                        <h2>DEFINISI WHISTLEBLOWING SYSTEM</h3>
                        <p>Mekanisme penyampaian pengaduan dugaan tindak pidana tertentu yang telah terjadi atau akan terjadi yang melibatkan pegawai dan orang lain yang yang dilakukan dalam organisasi tempatnya bekerja, dimana pelapor bukan merupakan bagian dari pelaku kejahatan yang dilaporkannya.</p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-anchor-placement="top-bottom">
                    <img src="<?php echo e(asset('assets/images/landing/about.jpg')); ?>" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <p>Kriteria Pengaduan</p>
            </header>
            <div class="row">
                <div class="col-lg-6" data-aos="zoom-out" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                    <img src="<?php echo e(asset('assets/images/landing/features.png')); ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                    <div class="row align-self-center gy-4">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Penyuapan/Gratifikasi</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Kecurangan Pengadaan Barang/Jasa</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Pemalakan Penyedia Barang/Jasa</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Korupsi</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Pencurian atau Penyalahgunaan Aset</h3>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>Benturan Kepentingan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <p>Jumlah Pengaduan</p>
            <h2 class="mt-3">Bulan November 2022</h2>
        </header>
        <div class="container">
            <canvas id="complaint-chart"></canvas>
        </div>
    </section>
  </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-script'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chart = document.getElementById('complaint-chart');

var violation = JSON.parse('<?php echo json_encode($violation); ?>')

new Chart(chart, {
    type: 'bar',
    data: {
        labels: violation,
        datasets: [{
            label: 'Jumlah Pengaduan',
            data: [12, 19, 3, 5, 2],
            borderWidth: 1,
            backgroundColor: '#012970'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.landing.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/landing.blade.php ENDPATH**/ ?>