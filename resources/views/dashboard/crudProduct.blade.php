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
    <div class="row pb-3">
        <div class="col-sm-12">
            <p class="Product-text">Product</p>
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
                            <td>{{ $product->product_cat }}</td>
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
                            <td>
                                {{-- <span class="btn btn-block btn-danger">
                                <i class="fas fa-trash"></i>
                            </span> --}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-id="{{ $product->id }}"
                                    data-message="Apakah kamu yakin ingin menghapus produk ini? ({{ $product->product_title }})"
                                    data-target="#modal-danger">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                            <td class="" style="text-align: center;">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-id="{{ $product->id }}" data-target="#modal-edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    {{-- Modal edit --}}
    <form method="POST" id="edit-form">
        @csrf
        @method('PUT')
        <div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            {{-- Input BOSSS --}}
                            <div class="form-group">
                                <label for="name">name</label>
                                <input type="text" class="form-control" id="name" placeholder="product name">
                            </div>
                            <div class="form-group">
                                <label for="harga">harga</label>
                                <input type="number" class="form-control" id="harga" placeholder="harga">
                            </div>
                            <div class="form-group">
                                <label for="stock">stock</label>
                                <input type="number" class="form-control" id="stock" placeholder="stock">
                            </div>
                            <div class="form-group">
                                <label for="category">category</label>
                                <input type="number" class="form-control" id="category" placeholder="category">
                            </div>
                            <div class="form-group">
                                <label for="gender">gender</label>
                                <input type="number" class="form-control" id="gender" placeholder="gender">
                            </div>
                            <div class="form-group">
                                <label for="brand">brand</label>
                                <input type="number" class="form-control" id="brand" placeholder="brand">
                            </div>
                            <div class="form-group">
                                <label for="desc">Textarea</label>
                                <textarea id="desc" class="form-control" rows="3" placeholder="descriptions"></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>

    {{-- Modal new --}}
    <form method="POST" id="new-form">
        @csrf
        <div class="modal fade" id="modal-new" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Produk baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            {{-- Input BOSSS --}}
                            <div class="form-group">
                                <label for="newName">name</label>
                                <input type="text" class="form-control" id="newName" placeholder="product name">
                            </div>
                            <div class="form-group">
                                <label for="newHarga">harga</label>
                                <input type="number" class="form-control" id="newHarga" placeholder="harga">
                            </div>
                            <div class="form-group">
                                <label for="newStock">stock</label>
                                <input type="number" class="form-control" id="newStock" placeholder="stock">
                            </div>
                            <div class="form-group">
                                <label for="newCategory">category</label>
                                <input type="number" class="form-control" id="newCategory" placeholder="category">
                            </div>
                            <div class="form-group">
                                <label for="newGender">gender</label>
                                <input type="number" class="form-control" id="newGender" placeholder="gender">
                            </div>
                            <div class="form-group">
                                <label for="newBrand">brand</label>
                                <input type="number" class="form-control" id="newBrand" placeholder="brand">
                            </div>
                            <div class="form-group">
                                <label for="newDesc">Textarea</label>
                                <textarea id="newDesc" class="form-control" rows="3" placeholder="descriptions"></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->


                    </div>
                    <div class="modal-footer justify-content-between">
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
                    <form action="/product" method="post">
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
