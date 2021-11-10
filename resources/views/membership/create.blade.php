@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Medlemsskap</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Du er nå på vei til å melde deg inn i Vestfold Digitale Ungdom, og vil ha demokratiske rettigheter i henhold til vedtektene, som f.eks. muligheten til å delta på årsmøtet, og å stille til valg til styret.</p>
                        
                        <p>Vestfold Digitale Ungdom vil benytte medlemsskapet ditt for å blandt annet søke om støtte fra offentlige aktører, og trenger derfor at du fyller inn endel mer informasjon om deg.</p>
                    </div>
                    <div class="row justify-content-left">
                        <form method=POST action='{{ route('membership.store') }}'>
                            @csrf

                            <div>
                                <input type=text name=firstname value='{{$user->firstname}}' required class="@error('firstname') is-invalid @enderror"> Fornavn
                                @error('firstname')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=lastname value='{{$user->lastname}}' required class="@error('lastname') is-invalid @enderror"> Etternavn
                                @error('lastname')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=number name=cellphone value='{{$user->cellphone}}' required class="@error('cellphone') is-invalid @enderror"> Mobil
                                @error('cellphone')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=email value='{{$user->email}}' readonly required class="@error('email') is-invalid @enderror"> Epost
                                @error('email')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=date name=birthday value='{{$user->birthday}}' required class="@error('birthday') is-invalid @enderror"> Fødselsdato
                                @error('birthday')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=address value='{{$user->address}}' required class="@error('address') is-invalid @enderror"> Adresse
                                @error('address')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=number name=postnumber value='{{$user->postnumber}}' required class="@error('postnumber') is-invalid @enderror"> Postnummer
                                @error('postnumber')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <select name=gender required class="@error('gender') is-invalid @enderror">
                                    <option value='unknown'></option>
                                    <option value='male'@if($user->gender == 'male') selected @endif>Mann</option>
                                    <option value='female'@if($user->gender == 'female') selected @endif>Kvinne</option>
                                    <option value='other'@if($user->gender == 'other') selected @endif>Annet</option>

                                </select> Kjønn
                                @error('gender')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <p><input type=checkbox name='auto_renew' value="1"> Ønsker du å automatisk fornye medlemsskapet ditt når det går ut om et år?</p>
                            </div>
                                    
                            <div>
                                <input type="submit" value="JA! Jeg vil bli medlem (50 kroner pr. år)" class="btn btn-success">
                            </div>
                        </form> 
                        
                        
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
