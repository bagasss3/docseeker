@extends('layout.dashboard')

@section('css')
<link rel="stylesheet" href={{ asset('css/vendor/datatables.css') }}>
<!-- DataTables -->
<link href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/r-2.4.1/sc-2.1.1/datatables.min.css" rel="stylesheet" />

@endsection



@section('js')

<script src={{ asset('js/crudProduct.js') }}></script>
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
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#modal-new">
            <i class="fa fa-plus"> </i>
            Masukkan Produk Baru
        </a>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Gender</th>
                    <th>Brand</th>
                    <th>title</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Weight (Gram)</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->custom_id }}</td>
                    <td>
                        @if ($product->product_cat == 0)
                        Shoes
                        @elseif ($product->product_cat == 1)
                        Glasses
                        @else
                        Bags
                        @endif
                    </td>

                    <td>
                        @if ($product->product_gender == 0)
                        Wanita
                        @else
                        Pria
                        @endif
                    </td>
                    <td>{{ $product->product_brand }}</td>
                    <td>{{ $product->product_title }}</td>
                    <td>{{ rupiah($product->product_harga) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->weight }}</td>
                    {{-- Modal Delete --}}
                    <div class="modal fade" id="modal-delete-{{$product->id}}" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLongTitle">Hapus Produk</h5>

                                </div>
                                <div class="modal-body">
                                    Apakah Kamu yakin ingin menghapus produk ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('admin.delete', ['id' => $product->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                    <td class="text-center">
                        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{$product->id}}">
                            <i class="fas fa-trash"> </i>
                        </a>
                    </td>
                    <td class="text-center" style="text-align: center;">
                        <a href="{{ route('admin.show', ['id' => $product->custom_id]) }}">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-id="{{ $product->id }}">
                                <i class="fas fa-pen">
                                </i>
                            </button>
                        </a>
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