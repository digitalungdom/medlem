@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Medlemstyper</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method=GET action='{{ route('membershipType.create') }}'>
                            <input type=submit class='btn btn-primary' value='Legg til ny medlemsskapstype'>
                    </form>                   
                    <table>

                    @foreach ($membershipType as $key => $type)
                        <tr><td>{{ $type->name }}</td></tr>

                    @endforeach
                    </table>
                    


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
