@extends('layouts.admin.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href=""> Users </a> </li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>

    @hasrole('Platform Admin')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">User Details</h6>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                    <div class="form-group col-md-6">
                        <label for="name" class="required">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{!! old('name') !!}" placeholder="Full Name" required>
                        @error('name')
                            <span class="text-danger">
                                {!! $message !!}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group control-label col-md-6 ">
                        <label for="email" class="required">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{!! old('email') !!}" placeholder="Email" required>
                        @error('email')
                            <span class="text-danger">
                                {!! $message !!}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group control-label col-md-6 ">
                        <label for="password" class="required">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"   placeholder="Password" required autocomplete="new-password">
                        @error('email')
                            <span class="text-danger">
                                {!! $message !!}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="role" class="required">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
                        <span class="text-danger" id="error-role">
                            @error('role')
                                {!! $message !!}
                            @enderror</span>

                    </div>
                    <div class="form-group col-md-6 d-none">
                        <label id="label"></label>
                        <select name="" id="select">

                        </select>
                        <span class="text-info" id="info"></span>
                    </div>


                    <div class="col-md-12 ">
                        <button class="btn btn-primary float-right" type="submit">Submit </button>
                    </div>

                </form>


                </div>

            </div>
        </div>
    </div>
@else
  <strong class="offset-5 mt-5">  You cannot create other users! </strong>
@endhasrole
   


@endsection


