@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lag ny rolle</div>
            </div>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('role.index') }}"> Tilbake</a>
        </div>
    </div>
</div>

{!! Form::open(array('route' => 'role.store','method'=>'POST')) !!}

<div class="card-body">
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Tilganger</strong>
            <br/>

            @foreach($permissions as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    </div>
</div>
{!! Form::close() !!}
@endsection
