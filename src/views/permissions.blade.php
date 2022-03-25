@extends('installer::layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="mar-ver pad-btm text-center">
                        <h3>Check Requirements & Folders Permissions</h3>
                        <p> If everything is green, you are good to go to the next step.</p>
                    </div>

                    <ul class="list-group">
                        <h5>Requirements..</h5>
                        @foreach($requirements['requirements'] as $type => $requirement)
                            @if($type == 'php')
                                <li class="list-group-item text-semibold">
                                    PHP {{ $phpSupportInfo['minimum'] }}

                                    @if ($phpSupportInfo['supported'])
                                        <i class="la la-check text-success float-right"></i>
                                    @else
                                        <i class="la la-close text-danger float-right"></i>
                                    @endif
                                </li>
                            @endif
                            @foreach($requirements['requirements'][$type] as $extention => $enabled)
                            <li class="list-group-item text-semibold">
                                {{ $extention }}

                                @if ($enabled)
                                    <i class="la la-check text-success float-right"></i>
                                @else
                                    <small>(please enable (<strong>{{ $extention }}</strong>) extension!)</small>
                                    <i class="la la-close text-danger float-right"></i>
                                @endif
                            </li>
                            @endforeach
                        @endforeach
                        <h5 class="p-2">Folder Permissions..</h5>
                        @foreach($permissions['permissions'] as $permission)
                        <li class="list-group-item text-semibold">
                            {{ $permission['folder'] }} 
                            <b>({{ $permission['permission'] }})</b>
                            @if ($permission['isSet'])
                                <i class="la la-check text-success float-right"></i>
                            @else
                                <i class="la la-close text-danger float-right"></i>
                            @endif
                        </li>
                        @endforeach
                    </ul>

                    <p class="text-center mt-3">
                        @if ( !isset($requirements['errors']) && !isset($permissions['errors']) && $phpSupportInfo['supported'] )
                            <a href="{{ route('purchase.code') }}" class="btn btn-primary">Go To Next Step</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
