@extends('layouts.app')
@section('title', '- Nevek')


@section('content')
    {{-- itt lesz a tartalom --}}

    <div class="container">
        <!--<ul>
            @foreach ($names as $name)
                <li @if($name == 'Viktor') style="font-weight: bold;" @endif>
                    @if($loop->last) Utolsó: @endif
                {{ $name }}</li>
            @endforeach
        </ul>-->

        <table class="table table-striped table-hover"> <!--bootstrap-ből-->
            <thead>
                <tr>
                    <th>Azonosító</th>
                    <th>Név</th>
                    <th>Létrehozás</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($names as $name)
                
                    <tr>
                        <td>{{ $name->id }}</td>
                        @empty($name->family)       <!---- ha $name->family == null ---->
                        <td><strong>Nincs adat</strong></td>
                        @else
                        <td>{{ $name->family->surname }}</td>
                        @endempty
                        <td>{{ $name->name }}</td>
                        <td>{{ $name->created_at }}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>




    </div>


@endsection