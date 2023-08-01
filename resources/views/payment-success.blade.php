@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="mt-5 text-center">
        <img src="../assets/img/success payment.svg" class="img-fluid text-center" alt="image success" style="height: 256px;">
        <div class="mt-4">
            <h3>Pembayaran Berhasil, Kamu bisa melacak paketmu melalui profile</h3>
        </div>
    </div>
</div>
@include('templates.footer')
@endsection