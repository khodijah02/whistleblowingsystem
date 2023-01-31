@extends('layouts.authentication.master')

@section('content')
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
                <div>
                    <a class="logo" href="">
                        <img class="img-fluid mb-3" src="{{ asset('assets/images/logo/logo-rsud.png') }}" alt="logorsud">
                        <h4 style="text-align: center">WHISTLEBLOWING SYSTEM</h4>
                        <h4 style="text-align: center">RSUD KOTA BOGOR</h4>
                    </a>
                </div>
                <div class="login-main">
                    <form class="theme-form" id="form-auth" method="post">
                        <h4>Masukan Akun</h4>
                        <div id="error_message"></div>
                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input class="form-control" type="text" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="form-group mb-0 mt-4">
                            <button id="submit" class="btn btn-primary btn-block" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('after-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#form-auth').submit(function (e) {
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();

               $.ajax({
                type: "post",
                url: "{{ route('jwt-login') }}",
                data: {
                    username:username,
                    password:password,
                },
                dataType: "json",
                beforeSend: function (response) {
                    $('#submit').attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response.status == 400 || response.status == 401 || response.status == 500) {
                        $('#error_message').html('');
                        $('#error_message').addClass('alert alert-danger');
                        $('#error_message').append('<span>'+response.message+'</span><br>');
                    } else {
                        var token = response.message;
                        localStorage.setItem('Authorization', token);
                        console.log(localStorage.getItem('Authorization'));
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Login Sukses',
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonText: 'Ya',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "get",
                                    url: "{{ route('admin.complaint') }}",
                                    headers: {
                                        "Authorization": 'Bearer '+token
                                    },
                                    success: function (response) {
                                        window.location.href = "{{ route('admin.complaint') }}"
                                    },
                                    error: function (response) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                        }).then((result) => {
                                            location.reload()
                                        });
                                    }
                                });
                            }
                        })
                    }
                    $('#submit').removeAttr('disabled', 'disabled');
                },
                error: function (response) {

                }
               });
            });
        });
    </script>
@endpush

