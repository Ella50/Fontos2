@extends('layouts.app')
@section('title', '- Profilom')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Adatok</h3>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ Auth::user()->name }}</h2>
                    <p class="card-text">profilja</p>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">E-mail: {{ Auth::user()->email }}</li>
                    <li class="list-group-item">Regisztráció dátuma: {{ Auth::user()->created_at }}</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h3>Jelszó megváltoztatása</h3>
            @if ($errors -> any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/profile/change-password" method="post">
                @csrf
                <div class="form-group">
                    <label for="password">Jelszó</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Jelszó újra</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary">Jelszócsere</button>
            </form>
        </div>
    </div>
@endsection