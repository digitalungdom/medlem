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
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Hmmm. Her var det noe feil</strong> Det var noe feil med hva du prøvde å gjøre<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
<div class="card-body">
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Navn:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Navn','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Tilganger:</strong>

            @foreach($permission as $value)
                 <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
        <br/>
        @endforeach

        <button type="submit" class="btn btn-primary">Lagre</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
