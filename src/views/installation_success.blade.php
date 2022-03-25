@extends('installer::layouts.app')

@section('content')
<div class="col-xl-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <h3>Congratulations!!!</h3>
                <p>You have successfully completed the installation process. Please Login to continue.</p>
            </div>
            @if(Route::has(config('nirapodInstaller.adminRouteName')))
            <div class="text-center">
                <a href="{{ route(config('nirapodInstaller.adminRouteName')) }}" class="btn btn-success">Login to Admin panel</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection