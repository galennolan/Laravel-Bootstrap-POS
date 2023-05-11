@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Employee</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $employee->phone_number) }}" required>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_photo">New Photo</label>
                                <input type="file" name="new_photo" id="new_photo" class="form-control @error('new_photo') is-invalid @enderror">

                                @error('new_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="current_photo">Current Photo</label>
                                <br>
                                @if($employee->photo)
                                    <img src="{{ asset('asset/img/employee/' . $employee->photo) }}" width="100" alt="{{ $employee->name }}">
                                    <br><br>
                                    <input type="checkbox" name="remove_photo" id="remove_photo" class="@error('remove_photo') is-invalid @enderror" value="1">
                                    <label for="remove_photo">Remove Photo</label>

                                    @error('remove_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @else
                                    No Photo
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection