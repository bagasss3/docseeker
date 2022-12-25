@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">
    @if(session()->has('info'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    @endif
    <div class="profile-container">
        <div><img src={{ asset('assets/img/profile.png') }} alt=""></div>
        <p class="profile-number">{{ $user->email }}</p>
        <p class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</p>

        <div class="profile-voucher">
            <p>0</p>
            <p>voucher</p>
        </div>

        <div class="pol">
            <ul class="profile-nav-menu">
                <li class="pointer" data-menu-active-profile="My orders">My orders</li>
                <li class="active pointer" data-menu-active-profile="chat">chat</li>
            </ul>

            <div class="profile-nav-item">
                <div data-menu-profile="My orders" class="d-none">
                    <div class="profile-menu-orders">
                        <p class="my-orders">My orders(0)</p>
                    </div>
                    <div class="status-order">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID Order</th>
                                    <th scope="col">Status Order</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="list-order order-body">
                                @foreach($data as $order)
                                <tr>
                                    <!-- <th scope="row" data-id="">12324242</th> -->
                                    <th>{{ $order->custom_id }}</th>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary" href="{{ route('user.detailOrder',['id'=>$order->custom_id]) }}">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 1rem" class="d-flex justify-content-end align-items-center">
                        <p class="find-my-orders me-2">Find my orders</p>
                        <div class="options" id="options">
                            <div class="hide-option option" id="hide-option">Order Status
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-menu-profile="chat" class="">
                    <div style="text-align: center">
                        <p>Belum ada pesan</p>
                        <p>Notifikasi order dan pesan dari Tokopop akan ditampilkan di sini </p>

                        <div class="chat-input-container">
                            <input type="text" placeholder="Pesan">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@include('templates.footer')
<script src={{ asset('js/profile.js') }}></script>
@endsection