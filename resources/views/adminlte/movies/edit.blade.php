@extends('adminlte::page')

@section('content_header')
    <h1>Detalles de la Película</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($movie, ['route' => ['admin.movies.update', $movie], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}

                @include('adminlte.movies.partials.form')

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wapper{
            position: relative;
            padding-bottom:56.25%;
        }
        .image-wapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')

    <script>

    </script>

@endsection
