<div class="form-group">
    {!! Form::label('title', 'Título:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título de la Película']) !!}

    @error('title')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('duration', 'Duración:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Duración (en minutos)']) !!}

    @error('duration')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('director', 'Director:') !!}
    {!! Form::text('director', null, ['class' => 'form-control', 'placeholder' => 'Dirigida por ...']) !!}

    @error('director')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
