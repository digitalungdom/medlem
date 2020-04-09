@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vis rolle</div>
            </div>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('role.index') }}"> Tilbake</a>
        </div>
    </div>
</div>


<div class="card-body">
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Navn:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Tilganger:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>


<div class="card-body">
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Brukere med rollen</strong>

            @if(!empty($users))
                <ul>
                @foreach($users as $u)
                    <li>{{ $u->firstname }} {{ $u->lastname }}</label>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
