@extends('layout.dashboard')

@section('css')
@endsection


@section('js')
@endsection

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" method="POST" action="{{ route('admin.update', ['id' => $product->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    {{-- Input BOSSS --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" placeholder="product name" name="product_title" value="{{$product->product_title}}">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" placeholder="stock" name="stock" min="1" value="{{$product->stock}}">
                            </div>
                            <div class="form-group">
                                    <label for="stock">weight</label>
                                    <input type="number" class="form-control" id="weight" placeholder="weight" name="weight" min="1" value="{{$product->weight}}" step=".01">
                                </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" name="product_gender">
                                    @foreach($gender as $gend)
                                        <option value="{{$gend->id}}" {{ $product->product_gender == $gend->id ? 'selected':'' }}>{{$gend->name}}</option>
                                    @endforeach
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
                                <input type="number" class="form-control" id="harga" placeholder="harga" name="product_harga" value="{{$product->product_harga}}">
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select class="form-control" name="product_cat">
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}" {{ $product->product_cat == $cat->id ? 'selected':'' }}>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="number" class="form-control" id="brand" placeholder="brand" name="product_brand" value="{{$product->product_brand}}">
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
                        <textarea id="desc" class="form-control" rows="3" placeholder="descriptions" name="product_desc">{{$product->product_desc}}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">

    </div>
    <!--/.col (right) -->
</div>
<!-- /.row -->
@endsection