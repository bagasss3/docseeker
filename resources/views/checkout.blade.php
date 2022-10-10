@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-5 mt-4 mb-4 me-3 ms-2">
            <div class="header-checkout">
                <ul style="list-style-type: none; " class="align-items-center d-flex justify-content-between rm text-white w-100">
                    <li class=" checkout-menu cursor-pointer" data-form-tab-control=" 1">1. Shipping Addres</li>
                    <li class="checkout-menu" data-form-tab-control=" 2">2. Delivery</li>
                    <!-- <li class="checkout-menu" data-form-tab-control=" 3">3. Payment</li> -->
                </ul>
                <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
            </div>
            <form action="" style="background-color: #dadada; border-radius: 1rem; padding: 2.5rem 1.5rem; min-height: 30rem;" name="formBiodata">
                <div class="d-none" data-form-sections="1">
                    <div class="mb-4">
                        <input type="email" class="form-control form-control-checkout" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail" data-error-message="ini ngak boleh kosong" value="">
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="number" id="number" placeholder="Number">
                    </div>
                    <div class="mb-4 d-flex justify-content-between" style="gap: 1em;">
                        <input type="text" class="form-control form-control-checkout" name="fName" id="firstName" placeholder="Firts Name">
                        <input type="text" class="form-control form-control-checkout" name="lName" id="lName" placeholder="Last Name">
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-checkout" name="country" id="country" placeholder="Indonesia" disabled>
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control form-control-checkout" id="streetAddres" name="streetAddres" placeholder="Street Address"></textarea>
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="zipCode" id="zipCode" placeholder="Zip Code">
                    </div>
                    <div class=" d-flex justify-content-between" style="gap: 1em;">
                        <select class="province-select js-states form-control-checkout" style="width: 65%;" name="province" id="province">
                            <option value=""></option>
                        </select>
                        <select class="city-select js-states form-control-checkout" style="width: 55%;" name="city" id="city">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <div class="d-none" data-form-sections="2">
                    <div class="delivery-header mt-3 mb-3">
                        <h4 class="text-center fw-bold mb-3">DELIVERY DETAILS :</h4>
                        <select class="form-select mb-4 select-courier" aria-label="select courier" id="selectCourier">
                            <option selected>Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>cost-ongkir
                        </select>
                        <select class="form-select mb-4 d-none select-service" aria-label="select service" id="selectService">
                        </select>
                    </div>
                </div>

                <!-- <div class="d-none" data-form-sections="3">
                    <div class="delivery-header mt-3 mb-3">
                        <h4 class="text-center fw-bold">PAYMENTS DETAILS :</h4>
                        <div class="form-payment-details-container">
                            <div class="form-check form-payment-details-choose">

                                <input type="radio" class="form-check-input" name="payment" id="dana" checked>
                                <label class="form-check-label h5" for="dana">
                                    <img src={{ asset('assets/img/dana.png') }} alt="" height="70px">
                                </label>
                                <div class="ck-bok-payment"></div>

                            </div>
                            <div class="form-check form-payment-details-choose">

                                <input type="radio" class="form-check-input" name="payment" id="ovo">
                                <label class="form-check-label h5" for="ovo">
                                    <img src={{ asset('assets/img/ovo.png') }} alt="" height="70px">
                                </label>
                                <div class="ck-bok-payment"></div>

                            </div>
                            <div class="form-check form-payment-details-choose">

                                <input type="radio" class="form-check-input" name="payment" id="sea-bank">
                                <label class="form-check-label h5" for="sea-bank">
                                    <img src={{ asset('assets/img/sea-bank.png') }} alt="" height="70px">
                                </label>
                                <div class="ck-bok-payment"></div>


                            </div>
                            <div class="form-check form-payment-details-choose">

                                <input type="radio" class="form-check-input" name="payment" id="s-pay">
                                <label class="form-check-label h5" for="s-pay">
                                    <img src={{ asset('assets/img/s-pay.png') }} alt="" height="60px">
                                </label>
                                <div class="ck-bok-payment"></div>

                            </div>
                        </div>

                    </div>
                </div> -->
            </form>
            <button class="btn btn-info fw-bold shadow-sm text-white  btn-lg btn-next-multistep-form w-100" style="margin:15px 0 ; ">Continue</button>

            <button class="btn btn-info fw-bold shadow-sm text-white  btn-lg btn-pay-multistep-form w-100 d-none" style="margin:15px 0 ; " id="btn-pay">Bayar Sekarang</button>


        </div>
        <div class="col-lg-5 mt-4 mb-4 me-3 ms-2">
            <div class="header-checkout">
                <h5 class=" text-end text-primary mt-4">Order Summary</h5>
                <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
            </div>
            <?php
            $total = 0;
            ?>
            @foreach ($data as $product)
            <div class="d-flex mb-3" style="gap: 1em;">
                <div class="box-shopping-item shadow">
                    <div class="my-2">
                        @if ($product->product_cat == 0)
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
                    <p class="text-primary h3 " style="margin-bottom: 0;">
                        {{ rupiah($product->product_harga * $product->qty) }}
                    </p>
                    <?php
                    $total += $product->product_harga * $product->qty;
                    ?>
                </div>
            </div>
            @endforeach
            <div class="input-group mt-3">
                <input type="text" class="form-control form-control-2 p-3" placeholder="Discount Code or Gift Card" />
                <button class="btn btn-primary" type="button">
                    <h6>Apply</h6>
                </button>
            </div>

            <div class="line line-2"></div>

            <div class="tax row-relative">
                <div class="pricing-total">
                    <div class="d-flex justify-content-between ">
                        <p class="h4">Sub Total</p>
                        <p class="h4 helper-temp-class">{{ rupiah($total) }}</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p class="h4">Savings</p>
                        <p class="h4 fw-bold">0%</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p class="h4">Shipping cost</p>
                        <p class="h4" data-description="">Rp 0</p>
                    </div>
                </div>
                <div class="grand-total">
                    <div class="d-flex justify-content-between ">
                        <h3 class="fw-bold">Grand Total</h3>
                        <h3 class="" data-total="">{{ rupiah($total) }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('templates.footer')
@endsection