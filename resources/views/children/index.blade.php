@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mine barn</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    @forelse(Auth::user()->children() as $child)
                        <li>{{ $child->firstname }}</li>
                    @empty
                        Ingen barn lagt til ennå
                    @endforelse
                    <p>
                        <a href="{{route('children.create')}}"><button class='btn btn-success'>Legg til barn</button></a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
