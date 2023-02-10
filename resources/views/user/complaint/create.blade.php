@extends('layouts.landing.master')

@section('content')
<main id="main">
    <section class="contact" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <header class="section-header" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <p>Form Pengaduan</p>
                </header>
                <div class="col-xl-12 contact">
                    <div id="error_message"></div>
                    <form action="" method="post" id="complaint_form">
                        <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                            <h5 class="text-center fw-bold mb-3">Data Pengaduan</h5>
                            <div class="row gy-4">
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <input id="ticket" type="hidden" name="complaint_ticket" value="{{ $complaintTicket }}" readonly>
                                    <label for="violation_type">Jenis Pelanggaran</label>
                                    <select class="form-select py-2" name="violation_type" id="violation_type">
                                        <option value="">-- Pilih Jenis Pelanggaran --</option>
                                        @foreach ($violation as $v)
                                        <option value="{{ $v->ID }}">{{ $v->NAMA }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="report_name">Nama Terlapor</label>
                                    <input class="form-control" id="reported_name" type="text" name="reported_name">
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
                                    <small class="text-danger">Format File Yang Bisa Diupload Adalah .doc, .docx, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .avi, .mp4, .3gp, .mp3</small>
                                </div>
                            </div>
                        </div>
                        <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="100">
                            <h5 class="text-center fw-bold mb-3">Data Pelapor</h5>
                            <div class="row gy-4">
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="reporter_name">Nama Pelapor</label>
                                    <input class="form-control" id="reporter_name" type="text" name="reporter_name">
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="province">Provinsi</label>
                                    <select class="form-select py-2" name="province" id="province">
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach ($province as $p)
                                        <option value="{{ $p->ID }}">{{ $p->NAMA }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="regency">Kabupaten</label>
                                    <select class="form-select py-2" name="regency" id="regency">
                                        <option value="">-- Pilih Kabupaten --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="district">Kecamatan</label>
                                    <select class="form-select py-2" name="district" id="district">
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="village">Kelurahan</label>
                                    <select class="form-select py-2" name="village" id="village">
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="reporter_address">Alamat Pelapor</label>
                                    <input class="form-control" id="reporter_address" type="text" name="reporter_address">
                                </div>
                                @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                                @endif
                            </div>
                            <button class="btn btn-primary mt-3" type="submit" id="complaint_submit_button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('after-script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                    url: "{{ route('complaint.store') }}",
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
                            text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                            icon: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            location.reload()
                        });

                    }
                });
            });

            $('#province').on('change', function () {
                var data = this.value;
                $.ajax({
                    type: "get",
                    url: "{{ route('get.regency') }}",
                    data: {data:data},
                    dataType: "json",
                    success: function (response) {
                        $('#regency').html('<option value="">-- Pilih Kabupaten --</option>');
                        $.each(response, function (key, value) {
                            $('#regency').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                        });
                    }
                });
            });

            $('#regency').on('change', function () {
                var data = this.value;
                $.ajax({
                    type: "get",
                    url: "{{ route('get.district') }}",
                    data: {data:data},
                    dataType: "json",
                    success: function (response) {
                        $('#district').html('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(response, function (key, value) {
                            $('#district').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                        });
                    }
                });
            });

            $('#district').on('change', function () {
                var data = this.value;
                $.ajax({
                    type: "get",
                    url: "{{ route('get.village') }}",
                    data: {data:data},
                    dataType: "json",
                    success: function (response) {
                        $('#village').html('<option value="">-- Pilih Kelurahan --</option>');
                        $.each(response, function (key, value) {
                            $('#village').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush




