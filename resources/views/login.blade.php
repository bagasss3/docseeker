@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 box-login shadow mt-4 mb-4 me-3 ms-2">
            <h1 class="fw-bold text-center">Create new account</h1>
            <p class="text-primary mt-3">Dengan mendaftar akun, Anda akan dapat melalui proses pembayaran lebih cepat, menyimpan alamat pengiriman, melihat dan melacak pesanan Anda di akun Anda dan banyak lagi.</p>

            <div class="mt-4 ">
                <a href="{{url('/register')}}">
                    <button type="button" class="btn btn-secondary text-primary shadow-sm fw-bold">REGISTER</button>
                </a>
            </div>
        </div>
        <div class="col-lg-6 box-login shadow mt-4 mb-4 me-3 ms-2">
            <h1 class="fw-bold text-center">LOGIN</h1>
            <form class=" mt-3">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter E-mail">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
                <div class="mt-4 ">
                    <button type="button mt-4" class="btn btn-secondary text-primary shadow-sm fw-bold">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('templates.footer')

@endsection