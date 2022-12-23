@extends('layout.main')

@section('content')
    @include('templates.search-bar')

    @include('templates.navbar')

    <!-- content -->
    <div class="container ">
        <div class="d-flex justify-content-between mt-5 text-primary">
            <p class="h2">User Address</p>
        </div>
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
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
        @endif
        <div class="line" style="margin-top: .25rem;margin-bottom: .5rem;"></div>

        <form method="POST" id="new-form" action="/address" name="">
        @csrf
        <div class="profile-menu-orders"></div>
            <div class="status-order">
            <div class="card-body">
                <div class="row">
                    <div class="mb-4">
                        <input type="email" class="form-control form-control-checkout" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail" data-error-message="ini ngak boleh kosong" value="">
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="number" id="number" placeholder="Number">
                    </div>
                    <div class="mb-4 d-flex justify-content-between" style="gap: 1em;">
                        <input type="text" class="form-control form-control-checkout" name="fName" id="firstName" placeholder="Firts Name">
                        <input type="text" class="form-control form-control-checkout" name="lName" id="lName" placeholder="Last Name">
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-checkout" name="country" id="country" placeholder="Indonesia" value="Indonesia">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control form-control-checkout" id="streetAddres" name="streetAddres" placeholder="Street Address"></textarea>
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="zipCode" id="zipCode" placeholder="Zip Code">
                    </div>
                    <div class=" d-flex justify-content-between" style="gap: 1em;">
                        <select class="province-select js-states form-control-checkout" style="width: 65%;" name="province" id="province">
                            <option value=""></option>
                        </select>
                        <select class="city-select js-states form-control-checkout" style="width: 55%;" name="city" id="city">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                @if(request()->get('checkout'))
                <a href="/address?checkout=true" class="btn btn-primary">Kembali</a>
                @else
                <a href="/address" class="btn btn-primary">Kembali</a>
                @endif
            </div>
        </form>
    </div>

@include('templates.footer')
@endsection
