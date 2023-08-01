@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container ">
    @if(session()->has('message'))
    <p class="alert alert-success">{{session('message')}}</p>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    @endif
    @if(session()->has('info'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    @endif
    <div class="align-content-center align-items-center  justify-content-center row mt-5" style="gap: 2em;">
        <div class="col-lg-3   text-center">
            <div class="title">
                <h2 class="fw-bold mb-2">BAGS</h2>
            </div>
            <a href="{{url('/product/?category=bags')}}">
                <div class="content-container shadow row-relative mx-auto">
                    <img src="../assets/img/bag.svg" alt="" class="img" />
                </div>
            </a>
        </div>
        <div class="col-lg-3   text-center">
            <div class="title">
                <h2 class="fw-bold mb-2">GLASSES</h2>
            </div>
            <a href="{{url('/product/?category=glasses')}}">
                <div class="content-container shadow row-relative mx-auto">
                    <img src="../assets/img/glasses.svg" alt="" class="img" />
                </div>
            </a>
        </div>
        <div class="col-lg-3   text-center">
            <div class="title">
                <h2 class="fw-bold mb-2">SHOES</h2>
            </div>
            <a href="{{url('/product/?category=shoes')}}">
                <div class="content-container shadow row-relative mx-auto">
                    <img src="../assets/img/shoes.svg" alt="" class="img" />
                </div>
            </a>
        </div>
        <div class="col-lg-3   text-center">
            <div class="title">
                <h2 class="fw-bold mb-2">FLASH SALE</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/sale.svg" alt="" class="img" />
            </div>
        </div>
        <div class="col-lg-3   text-center">
            <div class="title">
                <h2 class="fw-bold mb-2">NEW ARRIVAL</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/new item.svg" alt="" class="img" />
            </div>
        </div>
    </div>
</div>


@include('templates.footer')

@endsection