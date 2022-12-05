@extends('layout.main')

@section('content')
@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container">

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
                        <p class="find-my-orders">Find my orders</p>

                    </div>
                    <div style="display: flex;justify-content: end;margin-top: 1rem">
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