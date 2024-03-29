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
        <div class="d-flex justify-content-center row">
            @if(count($data)>0)
                @foreach ($data as $product)
                    <div class="col-lg-4 col-sm-6 mt-5 text-center box-item row-relative shadow">
                        @if ($product->product_cat == 0)
                            <a href="{{ route('product.show', ['id' => $product->custom_id]) }}?category=shoes" class="text-dark">
                            @elseif($product->product_cat == 1)
                                <a href="{{ route('product.show', ['id' => $product->custom_id]) }}?category=glasses" class="text-dark">
                                @else
                                    <a href="{{ route('product.show', ['id' => $product->custom_id]) }}?category=bags" class="text-dark">
                        @endif
                        <div class="row-relative mx-auto">
                            <img src="{{$product->images->image}}" alt="" height="128px" />
                        </div>
                        <!-- title n price -->
                        <div class="content-header mt-2 ">
                            <h5 class="pt-2 pb-2">{{ $product->product_title }}</h5>
                            <div class="price">
                                <p class="text-price text-center">{{ rupiah($product->product_harga) }}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            @else
            <div class="col-lg-4 col-sm-6 mt-5 text-center row-relative">
            <div class="row-relative mx-auto">
                <img src="./assets/img/shopping-cart.png" alt="" height="128px" />
            </div>
            <h5 class="pt-2 pb-2">Tidak ditemukan produk yang sesuai</h5>
            </div>
            @endif
        </div>

        <!-- loadmore button -->
        <div class="loadmore mt-4 text-center ">
            {{ $data->links() }}
        </div>

    </div>
    @include('templates.footer')
@endsection
