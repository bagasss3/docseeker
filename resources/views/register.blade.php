@extends('layout.main')

@section('content')

@include('templates.search-bar')

@include('templates.navbar')

<!-- content -->
<div class="container d-flex justify-content-center">
    <div class="box-login box-register shadow mt-4 mb-4 me-3 ms-2">
        <h1 class="text-center fw-bold">PERSONAL INFORMATION</h1>
        <form action="{{ route('user.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="fName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="fName" aria-describedby="fNameHelp" placeholder="Enter Firts Name">
                    </div>
                    <div class="mb-3">
                        <label for="lName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="lName" aria-describedby="lNameHelp" placeholder="Enter Last Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter E-mail">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
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