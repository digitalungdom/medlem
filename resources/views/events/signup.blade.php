@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Påmelding</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!$event->userIsMember()) 
                        <div class="alert alert-warning" role="alert">
                            Du kan ikke melde deg på, fordi du ikke er medlem. <a href="{{route ("medlemsskap.index")}}">Bli medlem</a>
                        </div>
                    @endif

                    @if(!$event->eventIsOpen())
                        <div class="alert alert-warning" role="alert">
                            Arrangementet er ikke åpent for påmelding ennå
                        </div>
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
