@extends('installer::layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <marquee behavior="" direction="right">
                        <h2>Welcome to {{ config('nirapodInstaller.owner') }}.</h2>
                    </marquee>
                    <div class="pad-btm text-center">
                        <h1>
                            <i class="la la-cog"></i> Installation Process..
                        </h1>
                        <h1 class="h3">{{ config('nirapodInstaller.scriptName') }}</h1>
                        <p>Before getting started , we need some information on the Database. You will need to know the following items before proceeding.</p>
                    </div>
                    <ol class="list-group">
                        <li class="list-group-item">
                            <i class="la la-check"></i> Database Name
                        </li>
                        <li class="list-group-item">
                            <i class="la la-check"></i> Database Username
                        </li>
                        <li class="list-group-item">
                            <i class="la la-check"></i> Database Password
                        </li>
                        <li class="list-group-item">
                            <i class="la la-check"></i> Database Hostname
                        </li>
                        <li class="list-group-item">
                            <i class="la la-check"></i> Purchase code
                        </li>
                    </ol>
                    <p>
                        If you are ready, hitting the <strong>"Let's go"</strong> button.
                    </p>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('permissions') }}" class="btn btn-success">
                            Let's go...
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection