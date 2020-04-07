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
                            <input type=text name=slug value='{{$event->slug}}' required class="@error('title') is-invalid @enderror"> URL-slug
                            @error('slug')
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
