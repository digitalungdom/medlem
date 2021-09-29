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
                        
                    <form method=POST action='{{ route('tickettypes.update', ['event' => $event[0]->slug, 'tickettype' => $tickettype->id] ) }}'>
                        @csrf
                        @method('PUT')
                        <div>
                          <input type=text name=name value='{{$tickettype->name}}' required class="@error('name') is-invalid @enderror"> Name
                           @error('name')
                             <div class="alert alert-danger">{{$message}}</div>
                           @enderror
                        </div>

                        <div>
                            <input type=text name=price value='{{$tickettype->price}}' required class="@error('price') is-invalid @enderror"> Pris
                            @error('price')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <input type=numeric name=maxPerUser value='{{$tickettype->maxPerUser}}' required class="@error('maxPerUser') is-invalid @enderror"> Max antall billetter per bruker
                            @error('maxPerUser')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div>
                            <textarea name=description class="@error('description') is-invalid @enderror">{{$tickettype->description}}</textarea>Beskrivelse av billettypen
                            @error('description')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div>
                            <input type=checkbox name=enabled value='1' @if($tickettype->enabled == 1)checked @endif class="@error('enabled') is-invalid @enderror"> Billettypen aktiv?
                            @error('enabled')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>


                        <div>
                            <input type=submit value='Lagre' class='btn btn-primary'>
                        </div>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
