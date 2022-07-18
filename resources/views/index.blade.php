@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container ">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif
    @if(session()->has('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-center row">
        <div class="col-lg-3 me-5 mt-5 text-center">
            <div class="title">
                <h2 class="fw-bold">BAGS</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/bag.svg" alt="" class="img" />
            </div>
        </div>
        <div class="col-lg-3 me-5 mt-5 text-center">
            <div class="title">
                <h2 class="fw-bold">GLASSES</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/glasses.svg" alt="" class="img" />
            </div>
        </div>
        <div class="col-lg-3 me-5 mt-5 text-center">
            <div class="title">
                <h2 class="fw-bold">SHOES</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/shoes.svg" alt="" class="img" />
            </div>
        </div>
        <div class="col-lg-3 me-5 mt-5 text-center">
            <div class="title">
                <h2 class="fw-bold">FLASH SALE</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/sale.svg" alt="" class="img" />
            </div>
        </div>
        <div class="col-lg-3 me-5 mt-5 text-center">
            <div class="title">
                <h2 class="fw-bold">NEW ARRIVAL ITEM</h2>
            </div>
            <div class="content-container shadow row-relative mx-auto">
                <img src="../assets/img/new item.svg" alt="" class="img" />
            </div>
        </div>
    </div>
</div>


@include('templates.footer')

@endsection