@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    @if(session()->has('info'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 mt-5 text-center d-flex justify-content-center">
            <!-- another content -->
            <div class="another-content">
                <a href="">
                    <div class="box-display-2 mx-auto my-2 row-relative shadow side-image" data-side-image-positions="1">
                        <img src="{{ $image1 }}" alt="" height="96px" />
                    </div>
                </a>

                <a href="">
                    <div class="box-display-2 shadow row-relative mx-auto shadow mt-4 side-image opacity-75" data-side-image-positions="2">
                        <img src="{{$image2}}" alt="" height="96px" />
                    </div>
                </a>

            </div>
            <!-- displayed content -->
            <a href="" class="text-dark">
                <div class="box-display shadow main-image">
                    <div class=" my-5">
                        <img src="{{$image2}}" alt="" height="128px" />
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
                <p class="text-primary mt-3 h3 fw-bold">{{ rupiah($data->product_harga) }}</p>
            </div>

            <!-- detail -->
            <div class="detail-item text-white">
                <h5>Details :</h5>
                <p>{{ $data->product_desc }}</p>
            </div>

            <!-- pricing -->
            @if ($is_edit)
            <form action="{{ route('cart.update', ['id' => $data->id]) }}" method="post">
                @method('put')
                @else
                <form action="{{ route('cart.store', ['id' => $data->id]) }}" method="post">
                    @endif
                    @csrf
                    <div class=" text-white d-flex mt-4">
                        <h6 class="my-auto me-4">Quantity</h6>
                        <div class="inline-group input-group my-auto">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary-2 btn-minus" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            @if ($is_edit)
                            <input class="form-control  text-center" min="1" name="qty" value="{{ $data->qty }}" type="number">
                            @else
                            <input class="form-control  text-center" min="1" name="qty" value="1" type="number">
                            @endif
                            <div class="input-group-append">
                                <button class="btn btn-secondary-2 btn-plus" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="pricing mt-2">
                        <button type="submit" class="btn btn-dark shadow-lg">
                            @if ($is_edit)
                            Update Product
                            @else
                            Add To Bag
                            @endif
                        </button>
                    </div>
                </form>
        </div>

    </div>



</div>

@include('templates.footer')
@endsection