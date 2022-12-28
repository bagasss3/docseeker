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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Transaksi</h3>

            </div>
            <div class="card-body ">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">ID Transaksi</label>
                    <label for="name" class="col-sm-10 col-form-label font-weight-normal">{{$payment->custom_id}}</label>
                </div>
                <div class="form-group row">
                    <label for="telepon" class="col-sm-2 col-form-label">Jumlah</label>
                    <label for="telepon" class="col-sm-10 col-form-label font-weight-normal">{{rupiah($payment->total_price)}}</label>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Waktu</label>
                    <label for="email" class="col-sm-10 col-form-label font-weight-normal">{{local($payment->created_at)}}</label>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Status</label>
                    @if($payment->payment_status == 1)
                    <label for="alamat" class="col-sm-10 col-form-label font-weight-normal">Menunggu Pembayaran</label>
                    @elseif($payment->payment_status==2)
                    <label for="alamat" class="col-sm-10 col-form-label font-weight-normal">Sudah Dibayar</label>
                    @else
                    <label for="alamat" class="col-sm-10 col-form-label font-weight-normal">Pembayaran Kadaluarsa</label>
                    @endif
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pelanggan</h3>

            </div>
            <div class="card-body ">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <label for="name" class="col-sm-10 col-form-label font-weight-normal">{{$buyer->first_name}} {{$buyer->last_name}}</label>
                </div>
                <div class="form-group row">
                    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                    <label for="telepon" class="col-sm-10 col-form-label font-weight-normal">{{$buyer->phone}}</label>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <label for="email" class="col-sm-10 col-form-label font-weight-normal">{{$buyer->email}}</label>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <label for="alamat" class="col-sm-10 col-form-label font-weight-normal">{{$buyer->street_address}}, {{$buyer->zip_code}}, {{$buyer->city}}, {{$buyer->province}}</label>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-lg-6">
        <form action="{{route('admin.editStatusOrder',['id'=>$data[0]->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Status Pemesanan</h3>

                </div>

                <div class="card-body ">
                    <div class="d-flex align-items-center">
                        <div class=" mr-3">Status</div>
                        <div class="">
                            @if($payment->payment_status == 2)
                            <select class="form-control" name="status">
                                @else
                                <select class="form-control" name="status" disabled>
                                    @endif
                                    @foreach($status as $status)
                                    <option value="{{$status->status}}" {{ $data[0]->status == $status->status ? 'selected':'' }}>{{$status->status}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    @if($payment->payment_status == 2)
                    <button type="submit" class="btn btn-default ">Kembali</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                    @else
                    <button type="submit" class="btn btn-default " disabled>Kembali</button>
                    <button type="submit" class="btn btn-info" disabled>Simpan</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Item</h3>

            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">No</th>
                            <th style="width: 40%">Nama Produk</th>
                            <th style="width: 20%">Jumlah</th>
                            <th style="width: 30%">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach($data as $order)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            @if($order->deleted_at)
                            <td>
                                {{$order->product_title}} (PRODUK TELAH DIHAPUS DARI TOKO)
                            </td>
                            @else
                            <td>
                                {{$order->product_title}}
                            </td>
                            @endif
                            <td>
                                {{$order->qty}}
                            </td>
                            <?php $total +=
                                $order->product_harga * $order->qty; ?>
                            <td class="">
                                {{rupiah($order->product_harga*$order->qty)}}
                            </td>
                        </tr>
                        @if($loop->last)
                        <tr>
                            <td></td>
                            <td>
                                Ongkir
                            </td>
                            <td>
                                1
                            </td>
                            <td class="">
                                {{rupiah($payment->total_price-$total)}}
                            </td>

                        </tr>
                        <tr>
                            <td><b>Total:</b></td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td class="">
                                {{rupiah($payment->total_price)}}
                            </td>

                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>





@endsection