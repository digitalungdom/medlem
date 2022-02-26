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
                            Du kan ikke melde deg på, fordi du ikke er medlem. <a href="{{route ("membership.index")}}">Bli medlem</a>
                        </div>
                    @endif

                    @if(!$event->eventIsOpen())
                        <div class="alert alert-warning" role="alert">
                            Arrangementet er ikke åpent for påmelding ennå
                        </div>
                    @endif

                    @if($event->tickets->count() > 0)
                        <div>
                            @foreach($event->tickets as $ticket)
                                <br>{{ $ticket->id }} - {{ $ticket->status }} - {{ $ticket->ticketTypes->name }}

                            @endforeach
                        </div>
                    @endif
                    
                    @forelse ($event->ticketTypes as $tickettype)
                        <ul class="list-group">
                            <li class="list-group-item">
                            {{ $tickettype->name}}
                            
                            
                            <form method=POST action={{ route('events.signup.doSignup', $event->slug)}}>
                                @csrf
                                <input type=hidden name='ticketType' value='{{ $tickettype->id }}'>
                                @if($tickettype->maxPerUser == 1)
                                    
                                    <input type=hidden name=numberOfTickets value=1>
                                @elseif($tickettype->maxPerUser > 1)
                                    <select name=numberOfTickets>
                                        @for($i=1;$i<=$tickettype->maxPerUser;$i++)
                                            <option value={{ $i }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                @endif
                                <input type=submit value='Bestill' class='btn btn-primary'>
                            </form>
                            </li>
                        </ul>
                    @empty
                        <div><p>Ingen billetter lagt til arrangementet ennå</p></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
