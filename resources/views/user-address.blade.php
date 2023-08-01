@extends('layout.main')

@section('content')
    @include('templates.search-bar')

    @include('templates.navbar')

    <!-- content -->
    <div class="container ">
        <div class="d-flex justify-content-between mt-5 text-primary">
            <p class="h2">Daftar Alamat</p>
        </div>
        @if(session()->has('info'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
            </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
        @endif
        <div class="card-header">
            @if(request()->get('checkout'))
            <a class="btn btn-primary btn-sm" href="/create-address?checkout=true">
                <i class="fa fa-plus"> </i>
                Masukkan Alamat Baru
            </a>
            @else
            <a class="btn btn-primary btn-sm" href="/create-address">
                <i class="fa fa-plus"> </i>
                Masukkan Alamat Baru
            </a>
            @endif
        </div>
        <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>
        
        <div class="profile-menu-orders"></div>
            <div class="status-order">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $address)
                        <tr>
                            <td scope="row">{{$address->email}}</td>
                            <td>{{$address->phone}}</td>
                            <td>{{$address->first_name}} {{$address->last_name}}</td>
                            <td>{{$address->street_address}}, {{$address->zip_code}}, {{$address->city_name}}, {{$address->province_name}}</td>
                            {{-- Modal Active --}}
                            <div class="modal fade" id="modal-active-{{$address->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLongTitle">Active Address</h5>

                                        </div>
                                        <div class="modal-body">
                                            @if($address->is_active == true)
                                            Alamat ini sudah menjadi alamat utama
                                            @else
                                            Aktifkan alamat ini sebagai alamat utama?
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            @if($address->is_active == true)
                                            <form action="{{ route('address.nonactive', ['id' => $address->id]) }}" method="post">
                                            @else
                                            <form action="{{ route('address.active', ['id' => $address->id]) }}" method="post">
                                            @endif
                                                @csrf
                                                @method('PUT')
                                                @if($address->is_active == true)
                                                <input type="submit" class="btn btn-danger" value="Nonaktifkan">
                                                @else
                                                <input type="submit" class="btn btn-success" value="Aktifkan">
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </div>
                            <td class="text-center">
                                @if($address->is_active == true)
                                <button class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modal-active-{{$address->id}}">Aktif</button>
                                @else
                                <button class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#modal-active-{{$address->id}}">Aktif</button>
                                @endif
                            </td>
                            <td>
                                @if(request()->get('checkout'))
                                <a type="button" class="btn btn-primary" href="{{ route('address.show',['id'=>$address->id]) }}?checkout=true">Detail</a>
                                @else
                                <a type="button" class="btn btn-primary" href="{{ route('address.show',['id'=>$address->id]) }}">Detail</a>
                                @endif
                            </td>
                            {{-- Modal Delete --}}
                            <div class="modal fade" id="modal-delete-{{$address->id}}" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLongTitle">Hapus Address</h5>

                                        </div>
                                        <div class="modal-body">
                                            Apakah Kamu yakin ingin menghapus address ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('address.destroy', ['id' => $address->id]) }}" method="post">
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
                                <button class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal-delete-{{$address->id}}">
                                    <i class="fas fa-trash"> </i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(request()->get('checkout'))
                <a href="/checkout" class="btn btn-primary">Checkout</a>
                @endif
            </div>
    </div>

@include('templates.footer')
@endsection
