@extends('layout.dashboard')

@section('css')

<link rel="stylesheet" href={{ asset('/css/vendor/datatables.css') }}>
<!-- DataTables -->
<link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/r-2.4.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />

@endsection



@section('js')
<script src={{ asset('/js/crudProduct.js') }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/r-2.4.1/sc-2.1.1/datatables.min.js"></script>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card">

    <div class="card-body">

        <!-- search -->
        <form action="/admin/orders" method="GET">
            <div class="row">
                <div class="form-group row">
                    <label for="date" class="col-form-label col-sm-2">Waktu Awal Pemesanan</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control input-sm" id="fromDate" name="fromDate"/>
                    </div>
                    <label for="date" class="col-form-label col-sm-2">Waktu Akhir Pemesanan</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control input-sm" id="toDate" name="toDate"/>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success" name="search" title="Search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id Pemesanan</th>
                    <th>Waktu Pemesanan</th>
                    <th>Status Pemesanan</th>
                    <th>Id Transaksi</th>
                    <th>Total Harga Pemesanan</th>
                    <th>Status Transaksi</th>
                    <th>Email Pembeli</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                @foreach($data as $order)
                <tr>
                    <td>{{ $order->custom_id }}</td>
                    <td>{{ local($order->created_at) }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment_id }}</td>
                    <td>{{ rupiah($order->total_price) }}</td>
                    @if($order->payment_status == 1)
                    <td>Belum Dibayar</td>
                    @elseif($order->payment_status==2)
                    <td>Sudah Dibayar</td>
                    @else
                    <td>Kadaluarsa</td>
                    @endif
                    <td>{{ $order->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.showDetailAsAdmin',['id'=>$order->custom_id]) }}" class="btn btn-block btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>


{{-- Modal new --}}
<form method="POST" id="new-form" action="/admin/product" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-new" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Produk baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" placeholder="product name" name="product_title">
                                    @error('product_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" placeholder="stock" name="stock" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="stock">weight</label>
                                    <input type="number" class="form-control" id="weight" placeholder="weight" name="weight" min="1" step=".01">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control" name="product_gender">
                                        <option value="0">Women</option>
                                        <option value="1">Men</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Produk 1</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" multiple name="image[]">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" placeholder="harga" name="product_harga">
                                </div>
                                <div class="form-group">
                                    <label for="category">Kategori</label>
                                    <select class="form-control" name="product_cat">
                                        <option value="0">Shoes</option>
                                        <option value="1">Glasses</option>
                                        <option value="2">Bags</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <input type="number" class="form-control" id="brand" placeholder="brand" name="product_brand">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Produk 2</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" multiple name="image[]">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Deskripsi Produk</label>
                            <textarea id="desc" class="form-control" rows="3" placeholder="descriptions" name="product_desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</form>

@endsection