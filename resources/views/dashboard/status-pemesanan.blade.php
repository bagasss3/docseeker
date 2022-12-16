@extends('layout.dashboard')

@section('css')
<link rel="stylesheet" href={{ asset('css/vendor/datatables.css') }}>
<!-- DataTables -->
{{-- <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
<link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}> --}}
@endsection



@section('js')
<script src={{ asset('js/vendor/datatables.js') }}></script>


<script src={{ asset('js/crudProduct.js') }}></script>
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
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
<div class="card">

    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Pemesanan</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>31313131</td>
                    <td>Accepted</td>
                    <td class="text-center">
                        <a type="button" class="btn btn-block btn-primary btn-sm">Detail</a>

                    </td>
                </tr>
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