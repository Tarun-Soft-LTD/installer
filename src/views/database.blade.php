@extends('installer::layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h3">Database setup</h1>
                        <p>Fill this form with valid database credentials</p>
                    </div>
                    @if (session('error'))
                    <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-warning">
                            <strong>Invalid Database Credentials!! </strong>
                            Please check your database credentials.
                          </div>
                        </div>
                      </div>
                    @elseif(session('errorMsg'))
                    <div class="row">
                        <div class="col-md-12">
                          <div class="alert alert-warning">
                            {{ session('errorMsg') }}
                          </div>
                        </div>
                      </div>
                    @endif

                    <form method="POST" action="{{ route('database.installation') }}">
                        @csrf
                        <div class="form-group">
                            <label for="db_host">Database Host</label>
                            <input type="text" class="form-control" id="db_host" name = "DB_HOST" value="127.0.0.1" required>
                            <input type="hidden" name = "keys[]" value="DB_HOST">
                        </div>
                        <div class="form-group">
                            <label for="db_name">Database Name</label>
                            <input type="text" class="form-control" id="db_name" name = "DB_DATABASE" required>
                            <input type="hidden" name = "keys[]" value="DB_DATABASE">
                        </div>
                        <div class="form-group">
                            <label for="db_user">Database Username</label>
                            <input type="text" class="form-control" id="db_user" name = "DB_USERNAME" required>
                            <input type="hidden" name = "keys[]" value="DB_USERNAME">
                        </div>
                        <div class="form-group">
                            <label for="db_pass">Database Password</label>
                            <input type="text" class="form-control" id="db_pass" name = "DB_PASSWORD">
                            <input type="hidden" name = "keys[]" value="DB_PASSWORD">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Connect Database..</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection