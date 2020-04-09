@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Roller og rettigheter</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form method=GET action='{{ route('role.create') }}'>
                            <input type=submit class='btn btn-primary' value='Legg til ny rolle'>
                        </form>

                        <table class="table table-bordered">
                            <tr>

                               <th>Name</th>
                               <th width="280px">Action</th>
                            </tr>
                              @foreach ($roles as $key => $role)
                              <tr>

                                  <td>{{ $role->name }}</td>
                                  <td>
                                      <a class="btn btn-info" href="{{ route('role.show',$role->id) }}">Show</a>

                                          <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a>


                                          {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'style'=>'display:inline']) !!}
                                              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                          {!! Form::close() !!}

                                  </td>
                              </tr>
                              @endforeach
                          </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
