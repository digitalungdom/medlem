@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rediger</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method=POST action='{{ route('events.update', $event) }}'>
                        @csrf
                        @method('PUT')
                        <div>
                          <input type=text name=name value='{{$event->name}}' required class="@error('title') is-invalid @enderror"> Name
                           @error('name')
                             <div class="alert alert-danger">{{$message}}</div>
                           @enderror
                        </div>

                        <div>
                            <input type=text name=slug value='{{$event->slug}}' required class="@error('slug') is-invalid @enderror"> URL-slug
                            @error('slug')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <input type=datetime-local name=startTime value='{{$event->startTime}}' required class="@error('startTime') is-invalid @enderror"> Starttidspunkt
                            @error('startTime')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <input type=datetime-local name=stopTime value='{{$event->stopTime}}' required class="@error('stopTime') is-invalid @enderror"> Sluttidspunkt
                            @error('stopTime')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <input type=numeric name=maxUsers value='{{$event->maxUsers}}' required class="@error('maxUsers') is-invalid @enderror"> Maks antall deltagere (-1 for å ha ubegrenset)
                            @error('maxUsers')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div>
                            <input type=checkbox name=mustBeMember value='1' @if($event->mustBeMember == 1)checked @endif class="@error('mustBeMember') is-invalid @enderror"> Må være medlem for å melde seg på?
                            @error('mustBeMember')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>


                        <div>
                            <input type=submit value='Lagre' class='btn btn-primary'>
                        </div>
                    </form>
                </div>

                <div class="card-body">

                    <a href='{{ route('tickettypes.index', $event->slug) }}'>Billettyper</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
