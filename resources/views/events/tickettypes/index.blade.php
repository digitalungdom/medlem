@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Billettyper</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Billettypene til arrangementet
                    <table>
                        <tr><th>Navn</th><th>Pris</th><th>Rediger</th></tr>
                        @foreach($tickettypes as $tt)
                            <tr><td>
                                {{ $tt->name}}
                            </td><td>
                                {{ $tt->price}}
                            </td><td>
                                <a href='{{ route('tickettypes.edit', ['tickettype' => $tt->id, 'event' => $event->slug])}}'>Rediger</a>
                                <form action='{{ route('tickettypes.destroy', ['tickettype' => $tt->id, 'event' => $event->id]) }}' method="POST">
                                    @csrf

                                    @method('DELETE')

                                    <input type=submit value='Slett' onclick="return confirm('Er du sikker på at du vil slette?')">
                                </form>
                            </td></tr>

                        @endforeach

                    </table>

                    <br>

                    Opprett ny billettype:
                    <form method=POST action={{ route('tickettypes.store', ['event' => $event->slug])}}>
                        @csrf
                        <input type=text name='name'> Navn på billettypen
                        @error('name')
                                <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <br />
                        <input type="number" name='price'> Pris på billettypen
                        @error('price')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <br />
                        <input type="hidden" name='event_id' value='{{$event->id}}'>
                        @error('event_id')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <input type="submit" value='Legg til billettype'>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
