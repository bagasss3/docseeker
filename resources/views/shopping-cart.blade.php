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
        @if(session()->has('info'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        @endif
        <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
        <?php $total = 0; ?>
        @foreach ($data as $product)
            <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                <div class="box-shopping-item shadow">
                    <div class="my-2">
                        <img src="{{$product->images->image}}" alt="" height="48px" />
                    </div>
                </div>
                <div class=" name-shopping-item w-25">
                    <h5 class="fw-bold">{{ $product->product_title }}</h5>
                </div>
                <div class="inline-group input-group ">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary-2 btn-minus" disabled>
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input class="form-control  text-center" min="0" name="quantity" value="{{ $product->qty }}"
                        type="number" disabled>
                    <div class="input-group-append">
                        <button class="btn btn-secondary-2 btn-plus" disabled>
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="price-shopping-cart ">
                    <p class="text-primary h3 " style="margin-bottom: 0;">
                        {{ rupiah($product->product_harga * $product->qty) }}</p>
                    <?php $total += $product->product_harga * $product->qty; ?>
                </div>
                <div class="action-button d-flex" style="gap: 1em;">
                    @if ($product->product_cat == 0)
                        <a href="{{ route('product.show', ['id' => $product->product_id]) }}?category=shoes">
                        @elseif($product->product_cat == 1)
                            <a href="{{ route('product.show', ['id' => $product->product_id]) }}?category=bags">
                            @else
                                <a href="{{ route('product.show', ['id' => $product->product_id]) }}?category=glasses">
                    @endif
                    <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                    <form action="{{ route('cart.delete', ['id' => $product->product_id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
        <div class="d-flex justify-content-between mt-3">
            <p class="h4 text-primary ">Total Harga</p>
            <h3 class="fw-bold">{{ rupiah($total) }}</h3>
        </div>

        <div class="button-shopping-cart loadmore mt-4 text-end">
            <a type="button" class="btn btn-secondary text-dark shadow-sm" href="{{ url('/') }}">Continue shopping</a>
            <a type="button" class="btn btn-success text-white shadow-sm fw-bold"
                href="{{ url('/checkout') }}">Checkout</a>
        </div>


    </div>


    @include('templates.footer')
@endsection
