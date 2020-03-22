@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Velkommen til medlemssystemet til Vestfold Digitale Ungdom.
                    <br />
                    Som medlem er det masse morsomme greier du kan gjøre.
                    <br />
                    Blablabla
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
