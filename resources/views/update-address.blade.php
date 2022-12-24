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

        <form method="POST" id="new-form" action="{{ route('address.update', ['id' => $address->id]) }}" name="">
        @csrf
        @method('PUT')
        <div class="profile-menu-orders"></div>
            <div class="status-order">
            <div class="card-body">
                {{-- Input BOSSS --}}
                <div class="row">
                    <div class="mb-4">
                        <input type="email" class="form-control form-control-checkout" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail" data-error-message="ini ngak boleh kosong" value="{{$address->email}}">
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="number" id="number" placeholder="Number" value="{{$address->phone}}">
                    </div>
                    <div class="mb-4 d-flex justify-content-between" style="gap: 1em;">
                        <input type="text" class="form-control form-control-checkout" name="fName" id="firstName" placeholder="Firts Name" value="{{$address->first_name}}">
                        <input type="text" class="form-control form-control-checkout" name="lName" id="lName" placeholder="Last Name" value="{{$address->last_name}}">
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-checkout" name="country" id="country" placeholder="Indonesia" value="{{$address->country}}">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control form-control-checkout" id="streetAddres" name="streetAddres" placeholder="Street Address">{{$address->street_address}}</textarea>
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control form-control-checkout" name="zipCode" id="zipCode" placeholder="Zip Code" value="{{$address->zip_code}}">
                    </div>
                    <div class="mb-4 d-flex justify-content-between" style="gap: 1em;">
                        <input type="hidden" id="provinceId" name="provinceId" value="{{$address->province_id}}">
                        <input type="text" class="form-control form-control-checkout" name="oldProvince" id="oldProvince" value="{{$address->province_name}}" disabled>
                        <input type="hidden" id="cityId" name="cityId" value="{{$address->city_id}}">
                        <input type="text" class="form-control form-control-checkout" name="oldCity" id="oldCity" value="{{$address->city_name}}" disabled>
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
                <button type="submit" class="btn btn-primary">Update</button>
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
