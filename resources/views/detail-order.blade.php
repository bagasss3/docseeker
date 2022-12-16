@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">

    <div class="order-container">
        <div class="d-flex ">
            <div class="me-3">
                <a type="button" class="btn btn-primary" href="{{ url('profile') }}">Kembali</a>
            </div>
            <div class="id-product-order d-flex justify-content-center align-items-center">
                <h4 class="fw-normal">Order ID: <span class="fw-bold">2121212</span> </h4>
            </div>
        </div>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <!-- <th scope="col"></th> -->
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row" class="">1</td>
                    <!-- <td>
                        <div class="box-shopping-item shadow d-flex justify-content-center align-items-center">
                            <div class="">
                                <img src="./assets/img/AdminLTELogo.png" alt="" height="48px" />
                            </div>
                        </div>
                    </td> -->
                    <td>
                        Makanan Kucing
                    </td>
                    <td>
                        <div class="inline-group input-group p-0">
                            <input class="form-control  text-center" min="0" name="quantity" value="2" type="number" disabled>
                        </div>
                    </td>
                    <td>
                        122222
                    </td>
                </tr>
                <tr class="">
                    <td scope="row" class="">1</td>
                    <!-- <td>
                        <div class="box-shopping-item shadow d-flex justify-content-center align-items-center">
                            <div class="">
                                <img src="./assets/img/AdminLTELogo.png" alt="" height="48px" />
                            </div>
                        </div>
                    </td> -->
                    <td>
                        Makanan Kucing
                    </td>
                    <td>
                        <div class="inline-group input-group p-0">
                            <input class="form-control  text-center" min="0" name="quantity" value="2" type="number" disabled>
                        </div>
                    </td>
                    <td>
                        122222
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

@include('templates.footer')
<script src={{ asset('js/profile.js') }}></script>
@endsection