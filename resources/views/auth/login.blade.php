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
                    <form class="theme-form" action="{{ route('login') }}" method="post">
                        @csrf
                        <h4>Masukan Akun</h4>
                        @if (session('status'))
                            <div class="text-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul style="margin: 0;">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input class="form-control" type="text" name="username" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" >
                        </div>
                        <div class="form-group mb-0 mt-4">
                            <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
