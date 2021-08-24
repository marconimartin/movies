<div class="row mb-3">

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Archivo de películas a importar (.csv)') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'csv/*']) !!}

            @error('file')
                <span class="text-danger">{{$message}}</span>
            @enderror

        </div>
            <p>Seleccione el archivo a importar. Este proceso puede repetirse sin problemas.</p>
    </div>
</div>

