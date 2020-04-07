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


                    <table>
                        @if($events) <tr><th>Navn</th><th>Tidspunkt</th><th>Deltagere</th><th>Type</th></tr> @endif
                        @forelse ($events as $event)
                            <tr>
                                <td><a href="{{ route('events.edit', $event->slug) }}">{{ $event->name}}</a></td><td>{{ $event->startTime }} til {{ $event->stopTime }}</td>
                                <td>@if($event->maxUsers > 0) {{ $event->maxUsers }}@endif</td>
                                <td>LAN-party</td>
                                </tr>
                        @empty
                           Ingen arrangementer lagt til ennå
                        @endforelse

                    </table>

                    <br>
                    <form method=POST action="{{ route("events.store") }}">
                        @csrf
                        <input type=text name=name placeholder="Arrangementsnavn">
                        <br />
                        <input type=text name=slug placeholder="URL-navn">
                        <br />
                        <input type=submit value='Legg til arrangement' class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
