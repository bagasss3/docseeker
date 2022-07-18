@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-lg-6 mt-5 text-center d-flex justify-content-center">
            <!-- another content -->
            <div class="another-content">
                <a href="">
                    <div class="box-display-2 mx-auto my-2 row-relative shadow ">
                        <img src="../assets/img/glasses.svg" alt="" class="img img-2" height="64px" />
                    </div>
                </a>

                <a href="">
                    <div class="box-display-2 shadow row-relative mx-auto shadow mt-4">
                        <img src="../assets/img/glasses.svg" alt="" class="img img-2" height="64px" />
                    </div>
                </a>

            </div>
            <!-- displayed content -->
            <a href="" class="text-dark">
                <div class="box-display shadow">
                    <div class=" my-5">
                        <img src="../assets/img/glasses.svg" alt="" height="128px" />
                    </div>
                    <div class=" mt-2 text-center">
                        <h6 class="fw-bold">2/2</h6>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-lg-6 mt-5 text-start ">
            <!-- content -->
            <div class="header-detail mb-4">
                <h3 class="fw-bold">{{ $data->product_title }}</h3>
                <p class="text-primary mt-3 h3 fw-bold">IDR {{ $data->product_harga }}-</p>
            </div>

            <!-- detail -->
            <div class="detail-item text-white">
                <h5>Details :</h5>
                <p>{{$data->product_desc}}</p>
            </div>

            <!-- pricing -->
            <div class=" text-white d-flex mt-4">
                <h6 class="my-auto me-4">Quantity</h6>
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
            </div>
            <div class="pricing mt-2">
                <button type="button" class="btn btn-dark shadow-lg">Add To Bag</button>
            </div>

        </div>

    </div>



</div>

@include('templates.footer')

@endsection