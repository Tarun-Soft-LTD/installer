@extends('installer::layouts.app')

@section('content')
<div class="col-xl-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h3>{{ config('nirapodInstaller.scriptName') }} Settings</h3>
                <p>Fill this form Admin login credentials.</p>
            </div>
            <p class="text-muted">
                <form method="POST" action="{{ route('administrator.setup.user') }}">
                    @csrf
                    <div class="form-group">
                        <label for="admin_name">Admin Name</label>
                        <input type="text" class="form-control @error('admin_name') is-invalid @enderror" id="admin_name" name="admin_name" value="{{ old('admin_name') }}">
                        @error('admin_name')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="admin_email">Admin Email</label>
                        <input type="email" class="form-control @error('admin_email') is-invalid @enderror" id="admin_email" name="admin_email" value="{{ old('admin_email') }}">
                        @error('admin_email')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="admin_password">Admin Password (At least 6 characters)</label>
                        <input type="password" class="form-control @error('admin_password') is-invalid @enderror" id="admin_password" name="admin_password">
                        @error('admin_password')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>
@endsection