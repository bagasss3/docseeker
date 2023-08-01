@extends('layout.dashboard')

@section('content')
    <div class="row pb-3">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Your Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter email" value="{{$user->name}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
