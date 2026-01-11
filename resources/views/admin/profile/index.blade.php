@extends('adminlte::page')

@section('title', 'Admin Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="col-md-8">
<div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header">
        <div class="card-title">Edit Profile</div>
      </div>
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <hr>

            <h4>Change Password</h4>

            <div class="form-group mb-3">
                <label>New Password (optional)</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mb-3">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Update Profile</button></div>
            
        </form>
</div></div>
@stop
