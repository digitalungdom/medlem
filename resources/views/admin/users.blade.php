@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Brukerliste</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <livewire:user-table/>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
