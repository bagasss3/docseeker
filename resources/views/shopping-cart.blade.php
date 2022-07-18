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

    <div class="d-flex justify-content-between mb-4 mt-4">
        <div class="box-shopping-item shadow">
            <div class="my-2">
                <img src="../assets/img/glasses.svg" alt="" height="48px" />
            </div>
        </div>
        <div class="name-shopping-item my-auto">
            <h5 class="fw-bold">Salvatore 53mm Square Sunglasses</h5>
        </div>
        <div class="inline-group input-group my-auto">
            <div class="input-group-prepend">
                <button class="btn btn-secondary-2 btn-minus">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <input class="form-control  text-center" min="0" name="quantity" value="1" type="number">
            <div class="input-group-append">
                <button class="btn btn-secondary-2 btn-plus">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="price-shopping-cart my-auto">
            <p class="text-primary h3" style="margin-bottom: 0;">IDR 1.600.000,-</p>

        </div>
    </div>

    <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
    <div class="d-flex justify-content-between mt-3">
        <p class="h4 text-primary ">Total Harga</p>
        <h3 class="fw-bold">IDR 3.200.000,-</h3>
    </div>

    <div class="button-shopping-cart loadmore mt-4 text-end">
        <a type="button" class="btn btn-secondary text-dark shadow-sm" href="{{url('/')}}">Continue shopping</a>
        <a type="button" class="btn btn-success text-white shadow-sm fw-bold" href="{{url('/checkout')}}">Checkout</a>
    </div>


</div>


@include('templates.footer')

@endsection