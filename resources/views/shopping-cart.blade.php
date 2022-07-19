@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container ">
    <div class="d-flex justify-content-between mt-5 text-primary">
        <p class="h2">Shopping Bag</p>
        <p class="h2">Order Summary</p>
    </div>
    <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
    <?php
    $total = 0;
    ?>
    @foreach($data as $product)
    <div class="d-flex justify-content-between mb-4 mt-4">
        <div class="box-shopping-item shadow">
            <div class="my-2">
                @if($product->product_cat == 0)
                <img src="../assets/img/shoes.svg" alt="" height="48px" />
                @elseif($product->product_cat == 1)
                <img src="../assets/img/bag.svg" alt="" height="48px" />
                @else
                <img src="../assets/img/glasses.svg" alt="" height="48px" />
                @endif
            </div>
        </div>
        <div class="name-shopping-item my-auto">
            <h5 class="fw-bold">{{ $product->product_title }}</h5>
        </div>
        <div class="inline-group input-group my-auto">
            <div class="input-group-prepend">
                <button class="btn btn-secondary-2 btn-minus">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <input class="form-control  text-center" min="0" name="quantity" value="{{ $product->qty }}" type="number">
            <div class="input-group-append">
                <button class="btn btn-secondary-2 btn-plus">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="price-shopping-cart my-auto">
            <p class="text-primary h3" style="margin-bottom: 0;">IDR {{ $product->product_harga * $product->qty}},-</p>
            <?php
            $total += $product->product_harga * $product->qty;
            ?>
        </div>
    </div>
    @endforeach
    <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
    <div class="d-flex justify-content-between mt-3">
        <p class="h4 text-primary ">Total Harga</p>
        <h3 class="fw-bold">IDR {{ $total }},-</h3>
    </div>

    <div class="button-shopping-cart loadmore mt-4 text-end">
        <a type="button" class="btn btn-secondary text-dark shadow-sm" href="{{url('/')}}">Continue shopping</a>
        <a type="button" class="btn btn-success text-white shadow-sm fw-bold" href="{{url('/checkout')}}">Checkout</a>
    </div>


</div>


@include('templates.footer')

@endsection