@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Arrangementer</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Dette er arrangementene vi har planlagt
                    <table>
                        <tr><th>Navn</th><th>Tidspunkt</th><th>Deltagere</th><th>Type</th><th>Påmelding</th></tr>
                        @foreach ($events as $event)
                            <tr><td>{{$event['name']}} </td>
                                <td>{{ $event['startTime']}} til {{ $event['stopTime']}}</td>
                                
                                <td>@if($event['maxUsers'] == -1) Ubegrenset @else {{ $event['maxUsers'] }} @endif </td>
                                <td>{{ $event->eventtype->name }}</td>
                            <td>
                                @if($event->eventIsOpen())<a href="{{route('events.signup', $event['slug'])}}">Påmelding</a>
                                @else Påmelding er ikke åpent ennå
                                @endif
                            
                            </td>

                            
                        @endforeach 
                        <tr><td>GlobeLAN 1337</td><td>1. januar 21:00 til 1. februar 2025 18:00</td><td>ca 1000</td><td>LAN-party</td><td>Påmelding</td></tr>
                        <tr><td>GL1337 CSGO-turnering</td><td>4. januar 2025 kl. 14:00 til 4. januar 2025 kl 16:00</td><td>Ubegrenset</td><td>LAN-turnering (krever gyldig billett)</td><td>Påmelding</td></tr>
                        <tr><td>GlobeONLINE Minecraft turnering</td><td>14. februar 2022 20:00 til 15. februar 2022 20:00</td><td>100</td><td>Online-turnering (krever gyldig medlemsskap)</td><td>Påmelding</td></tr>

                    </table>

{{--                     <br>

                    Tidligere arrangementer
                    <table>
                        <tr><th>Navn</th><th>Tidspunkt</th><th>Deltagere</th><th>Type</th><th>Påmelding</th></tr>
                        <tr><td>GlobeLAN 1336</td><td>Tidligere</td><td>Mange</td><td>LAN-party</td><td>Stengt. Du var deltager</td></tr>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
