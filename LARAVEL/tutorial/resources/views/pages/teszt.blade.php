
@extends('layouts.app') <!--melyik sablont használja-->
@section('title', ' - Teszt oldal') <!--title rész-->



@section('content') <!--ide szúrja be-->
<div class="jumbotron">
    <h1>Heloszia</h1>
    <p class="lead">sikerült a demo route :)</p>
    <a href="https://szbi-pg.hu" class="btn btn-primary btn-lg" role="button">Learn more</a>
    <p>{{ date('Y-m-d H:i:s') }}</p>
    <p>{{ $randomName }}</p> <!-- változó kiíratása (a tesztcontroller.php-ből)-->

</div>

@endsection