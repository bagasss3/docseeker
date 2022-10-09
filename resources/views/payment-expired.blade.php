@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="mt-5 text-center">
        <img src="../assets/img/expired payment.svg" class="img-fluid text-center" alt="image expired" style="height: 256px;">
        <div class="mt-4">
            <h3>Pembayaran Expired, Checkout kembali untuk melakukan pembayaran</h3>
            <div class=" d-flex gap-3 justify-content-center mt-2">
                <a type="button" class="btn btn-primary px-3 py-2" href="{{url('/shopping-cart')}}">Keranjang Belanja</a>
                <a type="button" class="btn btn-outline-secondary px-3 py-2" href="{{ url('/') }}">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@include('templates.footer')
@endsection