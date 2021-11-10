@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bli medlem</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   {{--  <a href="{{ $user->billingPortalUrl(route('membership.index')) }}"><button class="btn btn-primary">
                        @if ($user->hasPaymentMethod()) Endre bankkort
                        @else Legg til bankkort
                        @endif
                    </button></a> --}}
                    @if (!$user->isMember)
                        <a href="{{ route('membership.create')}}"><button class="btn btn-success">Jeg ønsker å bli medlem</button></a>
                    @else
                        <p>Du er medlem i Vestfold Digitale Ungdom. Vi er så glad for det!</p>
                        <p>Medlemsskapene dine er gyldig fra 
                        @foreach($user->memberships() as $membership)
                            {{ $membership->startTime}} til {{ $membership->stopTime }}

                        @endforeach
                        </p>
                    @endif
                    <br>
                    @if($user->is_parent) Du er registrert som foresatt. Her kan du etterhvert administrere dine barns medlemsskap @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
