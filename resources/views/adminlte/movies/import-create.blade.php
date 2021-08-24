@extends('adminlte::page')

@section('content_header')
    <h1>Crear Película</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.movies.import-store', 'autocomplete' => 'off', 'files' => true]) !!} <!-- files => true (enable file upload) -->

                @include('adminlte.movies.partials.import-form')

                {!! Form::submit('Importar Películas', ['class' => 'btn btn-primary']) !!}
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
