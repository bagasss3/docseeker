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
                    <th>No</th>
                    <th>category</th>
                    <th>gender</th>
                    <th>brand</th>
                    <th>title</th>
                    <th>harga</th>
                    <th>desc</th>
                    <th>stock</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }} </td>
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
                    <td>{{ $product->product_desc }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-center">
                        {{-- <span class="btn btn-block btn-danger">
                                <i class="fas fa-trash"></i>
                            </span> --}}
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-id="{{ $product->id }}" data-message="Apakah kamu yakin ingin menghapus produk ini? ({{ $product->product_title }})" data-target="#modal-danger">
                            <i class="fas fa-trash"></i>
                        </button>

                    </td>
                    <td class="text-center" style="text-align: center;">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-id="{{ $product->id }}" href="{{url('/admin/update-produk')}}">
                            <i class="fas fa-pen"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- Modal new --}}
<form method="POST" id="new-form" action="/admin/product">
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
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" placeholder="stock" name="stock" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control">
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Produk 1</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
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
                                    <select class="form-control">
                                        <option>Tas</option>
                                        <option>Sepatu</option>
                                        <option>Kacamata</option>
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
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
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
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
</form>

{{-- Modal Delete --}}
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <form action="/admin/product" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-outline-light" value="Delete">
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection