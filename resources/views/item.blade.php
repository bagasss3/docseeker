@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="d-flex justify-content-center row">
        @foreach ($data as $product)
        <div class="col-lg-4 col-sm-6 mt-5 text-center box-item row-relative shadow">
            @if($product->product_cat==0)
            <a href="{{route('product.show',['id'=>$product->id])}}?category=shoes" class="text-dark">
                @elseif($product->product_cat==1)
                <a href="{{route('product.show',['id'=>$product->id])}}?category=bags" class="text-dark">
                    @else
                    <a href="{{route('product.show',['id'=>$product->id])}}?category=glasses" class="text-dark">
                        @endif
                        <div class="row-relative mx-auto">
                            @if($product->product_cat == 0)
                            <img src="../assets/img/shoes.svg" alt="" height="128px" />
                            @elseif($product->product_cat == 1)
                            <img src="../assets/img/bag.svg" alt="" height="128px" />
                            @else
                            <img src="../assets/img/glasses.svg" alt="" height="128px" />
                            @endif
                        </div>
                        <!-- title n price -->
                        <div class="content-header mt-2 ">
                            <h5 class="pt-2 pb-2">{{ $product->product_title }}</h5>
                            <div class="price">
                                <p class="text-price text-center number-format">{{ $product->product_harga }}</p>
                            </div>
                        </div>
                    </a>
        </div>
        @endforeach
    </div>

    <!-- loadmore button -->
    <div class="loadmore mt-4 text-center ">
        <button type="button" class="btn btn-secondary text-dark shadow-lg">Load More</button>
    </div>

</div>
@include('templates.footer')

@endsection