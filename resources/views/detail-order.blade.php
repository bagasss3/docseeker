@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">

    <div class="order-container">
        <div class="d-flex ">
            <div class="me-3">
                <a type="button" class="btn btn-primary" href="{{ url('profile') }}">Kembali</a>
            </div>
            <div class="id-product-order d-flex justify-content-center align-items-center">
                <h4 class="fw-normal">Order ID: <span class="fw-bold">{{ $orderId }}</span></h4>
            </div>
        </div>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <!-- <th scope="col"></th> -->
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $order)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>
                        {{$order->product_title}}
                    </td>
                    <td>
                        {{$order->qty}}
                    </td>
                    <td class="">
                        Rp. {{$order->product_harga}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@include('templates.footer')
<script src={{ asset('js/profile.js') }}></script>
@endsection