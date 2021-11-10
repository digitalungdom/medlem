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
                        <p>Du er nå på vei til å legge til ditt barn i medlemssystemet til Vestfold Digitale Ungdom. Som foresatt har du mulighet til å gjøre ting på vegne av ditt barn, som f.eks. melde dem på til arrangementer eller bli medlem i organisasjonen. Du vil også automatisk bli oppført som pårørende, slik at dersom noe skal skje med barnet på noen av våre arrangementer, vil vi kontakte deg. </p>
                        <p>All informasjon vi spør om her gjelder barnet. Du behøver ikke å oppgi epost og mobil, men øvrige felter er påkrevd.</p>
                    </div>
                    <div class="row justify-content-left">
                        <form method=POST action='{{ route('children.store') }}'>
                            @csrf

                            <div>
                                <input type=text name=firstname value='{{ old('firstname')}}' required class="@error('firstname') is-invalid @enderror"> Fornavn
                                @error('firstname')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=lastname value='{{ old('lastname') }}' required class="@error('lastname') is-invalid @enderror"> Etternavn
                                @error('lastname')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=number name=cellphone value='{{ old('cellphone') }}' class="@error('cellphone') is-invalid @enderror"> Mobil
                                @error('cellphone')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=email value='{{ old('email')}}' class="@error('email') is-invalid @enderror"> Epost
                                @error('email')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=date name=birthday value='{{ old('birthday')}}' required class="@error('birthday') is-invalid @enderror"> Fødselsdato
                                @error('birthday')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=text name=address value='{{ old('address')}}' required class="@error('address') is-invalid @enderror"> Adresse
                                @error('address')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <input type=number name=postnumber value='{{ old('postnumber') }}' required class="@error('postnumber') is-invalid @enderror"> Postnummer
                                @error('postnumber')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div>
                                <select name=gender required class="@error('gender') is-invalid @enderror">
                                    <option value='unknown'></option>
                                    <option value='male'@if( old('gender') == 'male') selected @endif>Mann</option>
                                    <option value='female'@if(old('gender') == 'female') selected @endif>Kvinne</option>
                                    <option value='other'@if(old('gender') == 'other') selected @endif>Annet</option>

                                </select> Kjønn
                                @error('gender')
                                   <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                                    
                            <div>
                                <input type="submit" value="Registrer barn" class="btn btn-success">
                            </div>
                        </form> 
                        
                        
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
