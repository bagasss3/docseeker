@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-5 mt-4 mb-4 me-3 ms-2">
            <ul class="d-flex justify-content-between nav nav-pills nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="shopping-address-tab" data-bs-toggle="tab" data-bs-target="#shopping-address" type="button" role="tab" aria-controls="shopping-address" aria-selected="true">1. Shipping Address</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">2. Delivery</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">3. Payment</button>
                </li>
            </ul>
            <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="shopping-address" role="tabpanel" aria-labelledby="shopping-address-tab">
                    <div class=" box-checkout-item mt-3 mx-auto shadow">
                        <form action="#" method="POST" class="mt-3 mb-3">
                            <div class="mb-4">
                                <input type="email" class="form-control form-control-checkout " name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail">
                            </div>
                            <div class="mb-4">
                                <input type="number" class="form-control form-control-checkout" name="number" id="number" placeholder="Number">
                            </div>
                            <div class="mb-4 d-flex justify-content-between" style="gap: 1em;">
                                <input type="text" class="form-control form-control-checkout" name="fName" id="fName" placeholder="Firts Name">
                                <input type="text" class="form-control form-control-checkout" name="lName" id="lName" placeholder="Last Name">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control form-control-checkout" name="country" id="country" placeholder="Country">
                            </div>
                            <div class="mb-4">
                                <textarea class="form-control form-control-checkout" id="streetAddres" placeholder="Street Address"></textarea>
                            </div>
                            <div class=" d-flex justify-content-between" style="gap: 1em;">
                                <input type="number" class="form-control form-control-checkout" name="zipCode" id="zipCode" placeholder="Zip Code">
                                <input type="text" class="form-control form-control-checkout" name="city" id="city" placeholder="City">
                                <input type="text" class="form-control form-control-checkout" name="province" id="province" placeholder="Province">
                            </div>
                        </form>
                    </div>
                    <div class="mt-4" id="myTab" role="tablist">
                        <button class="btn btn-info fw-bold shadow-sm text-white w-100 btn-lg" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">Continue</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                    <div class=" box-checkout-item mt-3 mx-auto shadow">
                        <div class="delivery-header mt-3 mb-3">
                            <h4 class="text-center fw-bold">DELIVERY DETAILS :</h4>
                            <div class="form-check mt-3 d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        Instant Courier :
                                    </label>
                                </div>
                                <h5>Rp 40.000,-</h5>
                            </div>
                            <div class="form-check  d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        Sameday &#09&#09 &#09:
                                    </label>
                                </div>
                                <h5>Rp 40.000,-</h5>
                            </div>
                            <div class="form-check  d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        JNE :
                                    </label>
                                </div>
                                <h5>Rp 20.000,-</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4" id="myTab" role="tablist">
                        <button class="btn btn-info fw-bold shadow-sm text-white w-100 btn-lg" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">Continue</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <div class=" box-checkout-item mt-3 mx-auto shadow">
                        <div class="delivery-header mt-3 mb-3">
                            <h4 class="text-center fw-bold">PAYMENTS DETAILS :</h4>
                            <div class="form-check mt-3 d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        Instant Courier :
                                    </label>
                                </div>
                                <h5>Rp 40.000,-</h5>
                            </div>
                            <div class="form-check  d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        Sameday &#09&#09 &#09:
                                    </label>
                                </div>
                                <h5>Rp 40.000,-</h5>
                            </div>
                            <div class="form-check  d-flex justify-content-between">
                                <div>
                                    <input type="radio" class="form-check-input" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label h5" for="flexRadioDefault1">
                                        JNE :
                                    </label>
                                </div>
                                <h5>Rp 20.000,-</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4" id="myTab" role="tablist">
                        <button class="btn btn-info fw-bold shadow-sm text-white w-100 btn-lg" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="delivery" aria-selected="false">Continue</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mb-4 me-3 ms-2">
            <div class="header-checkout">
                <h5 class=" text-end text-primary">Order Summary</h5>
                <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
            </div>
            <div class="d-flex" style="gap: 1em;">
                <div class="box-shopping-item shadow">
                    <div class="my-2">
                        <img src="../assets/img/glasses.svg" alt="" height="48px" />
                    </div>
                </div>
                <div class="name-shopping-item my-auto">
                    <h5 class="fw-bold">Salvatore 53mm Square Sunglasses</h5>
                    <p class="text-primary h3" style="margin-bottom: 0;">IDR 1.600.000,-</p>
                </div>
            </div>
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
                        <p class="h4">IDR 1.600.000,-</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p class="h4">Savings</p>
                        <p class="h4 fw-bold">0%</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p class="h4">Shipping cost</p>
                        <p class="h4 ">IDR 40.000,-</p>
                    </div>
                </div>
                <div class="grand-total">
                    <div class="d-flex justify-content-between ">
                        <h3 class="fw-bold">Grand Total</h3>
                        <h3>IDR 1.740.000,-</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('templates.footer')

    @endsection