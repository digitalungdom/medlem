@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lag ny medlemsskapstype</div>
            </div>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('membershipType.index') }}"> Tilbake</a>
        </div>
    </div>
</div>

{!! Form::open(array('route' => 'membershipType.store','method'=>'POST')) !!}

<div class="card-body">
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-group">
            <strong>Innstillinger</strong>
            <br/>
            {!! Form::text('maxAge', null, array('placeholder' => 'Maksalder','class' => 'form-control')) !!}
            {!! Form::text('minAge', null, array('placeholder' => 'Minstealder','class' => 'form-control')) !!}
            {!! Form::text('price', null, array('placeholder' => 'Kontigentpris','class' => 'form-control')) !!}
            {!! Form::checkbox('hidden', true ) !!}
            {!! Form::label('hidden', 'Skjult type?') !!}
           
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    </div>
</div>
{!! Form::close() !!}
@endsection
