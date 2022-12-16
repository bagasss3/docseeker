@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->

<div class="container d-flex justify-content-center">
    <div class="box-login box-register shadow mt-4 mb-4 me-3 ms-2">
        <h1 class="text-center fw-bold">PERSONAL INFORMATION</h1>
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
        <form action="{{ route('user.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="fName" class="form-label">First Name</label>
                        <input type="text" class="form-control form-control-login" name="first_name" id="fName" aria-describedby="fNameHelp" placeholder="Enter First Name">
                    </div>
                    <div class="mb-3">
                        <label for="lName" class="form-label">Last Name</label>
                        <input type="text" class="form-control form-control-login" name="last_name" id="lName" aria-describedby="lNameHelp" placeholder="Enter Last Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control form-control-login" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter E-mail">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Enter Password">
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-secondary fw-bold shadow-sm text-primary w-100 btn-register">REGISTER</button>
            </div>
        </form>
    </div>
</div>

@include('templates.footer')

@endsection