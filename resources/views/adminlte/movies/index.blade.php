@extends('adminlte::page')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.movies.create')}}">Agregar Película</a>
    <h1>Listado de Películas</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    @livewire('admin.movies-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Movies list.'); </script>
@stop
