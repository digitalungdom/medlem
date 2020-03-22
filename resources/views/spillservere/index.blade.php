@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Spillservere</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Her er public-gameservere vi har satt opp
                    <table>
                        <tr><th>Navn</th><th>Spill</th><th>Antall spillere</th><th>Tilkobling</th><th>Info</th></tr>
                        <tr><td>GlobeONLINE CSGO Public #1</td><td>Counter-Strike:GO</td><td>3/32</td><td>game01.digitalungdom.no:12343</td><td>Map: de_dust</td></tr>
                        <tr><td>GlobeONLINE Factorio</td><td>Factorio</td><td>2/50</td><td>game02.digitalungdom.no:54234</td><td>Gametime: 32 minutter</td></tr>
                        <tr><td>GlobeONLINE MineCraft</td><td>MineCraft</td><td>10/20</td><td>game01.digitalungdom.no:6654</td><td></td></tr>

                    </table>

                    <br>
                    Private servere - Du har rolle som <b>gamecrew</b> og kan derfor opprette ubegrenset med spillservere.

                    <table>
                        <tr><th>Navn</th><th>Tidspunkt</th><th>Deltagere</th><th>Type</th><th>Påmelding</th></tr>
                        <tr><td>GlobeLAN 1336</td><td>Tidligere</td><td>Mange</td><td>LAN-party</td><td>Stengt. Du var deltager</td></tr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
