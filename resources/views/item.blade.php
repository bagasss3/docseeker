@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="d-flex justify-content-center row">
        <div class="col-lg-4 col-sm-6 mt-5 text-center box-item row-relative shadow">
            <a href="{{url('selected-item')}}" class="text-dark">
                <div class="row-relative mx-auto">
                    <img src="../assets/img/glasses.svg" alt="" height="128px" />
                </div>
                <!-- title n price -->
                <div class="content-header mt-2 ">
                    <h5 class="pt-2 pb-2">Salvatore Ferragamo SF144SL Aviator Sunglasses</h5>
                    <div class="price">
                        <p class="text-price text-center">IDR 1.730.000,-</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- loadmore button -->
    <div class="loadmore mt-4 text-center ">
        <button type="button" class="btn btn-secondary text-dark shadow-lg">Load More</button>
    </div>

</div>
@include('templates.footer')

@endsection