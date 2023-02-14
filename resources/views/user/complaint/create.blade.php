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
                    <div id="add_complaint_error_message"></div>
                    <form action="" method="post" id="add_complaint">
                        <div class="php-email-form mt-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="200">
                            <h5 class="text-center fw-bold mb-3">Data Pengaduan</h5>
                            <div class="row gy-4">
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <input id="ticket" type="hidden" name="complaint_ticket" value="{{ $complaintTicket }}" readonly>
                                    <label for="violation_type">Jenis Pelanggaran</label>
                                    <select class="form-select py-2" name="violation_type" id="violation_type" required>
                                        <option value="">-- Pilih Jenis Pelanggaran --</option>
                                        @foreach ($violation as $v)
                                        <option value="{{ $v->ID }}">{{ $v->NAMA }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="report_name">Nama Terlapor</label>
                                    <input class="form-control" id="reported_name" type="text" name="reported_name" required>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="date">Tanggal Perkiran Kejadian</label>
                                    <input class="form-control" id="date" type="date" name="date" required>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label for="address">Lokasi Kejadian</label>
                                    <input class="form-control" id="address" type="text" name="address" required>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label for="desc">Uraian Pengaduan</label>
                                    <textarea name="desc" id="desc" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label for="file">Lampiran Bukti</label>
                                    <input name="file" type="file" id="file" class="form-control" required>
                                    <small class="text-danger">Batas Upload File: 10 mb</small><br>
                                    <small class="text-danger">Format File Yang Bisa Diupload: .doc, .docx, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .avi, .mp4, .3gp, .mp3</small>
                                </div>
                            </div>
                            <h5 class="text-center fw-bold mb-3 mt-5">Data Pelapor</h5>
                            <div class="row gy-4">
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="reporter_name">Nama Pelapor</label>
                                    <input class="form-control" id="reporter_name" type="text" name="reporter_name" required>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="province">Provinsi</label>
                                    <select class="form-select py-2" name="province" id="province" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach ($province as $p)
                                        <option value="{{ $p->ID }}">{{ $p->NAMA }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="regency">Kabupaten</label>
                                    <select class="form-select py-2" name="regency" id="regency" required>
                                        <option value="">-- Pilih Kabupaten --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="district">Kecamatan</label>
                                    <select class="form-select py-2" name="district" id="district" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="village">Kelurahan</label>
                                    <select class="form-select py-2" name="village" id="village" required>
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-2 mt-4">
                                    <label for="reporter_address">Alamat Pelapor</label>
                                    <input class="form-control" id="reporter_address" type="text" name="reporter_address" required>
                                </div>
                                @if (config('services.recaptcha.key'))
                                <div class="g-recaptcha mt-5" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                                @endif
                            </div>
                            <button class="mt-4" type="submit" id="add_complaint_button">Submit</button>
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
    <script src="{{ asset('assets/js/script-landing.js') }}"></script>
@endpush




