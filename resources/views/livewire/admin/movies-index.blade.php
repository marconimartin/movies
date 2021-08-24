<div class="card">


    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="buscar película">

    </div>

    @if ($movies->count())

        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Duración</th>
                        <th>Director</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{$movie->id}}</td>
                            <td>{{$movie->title}}</td>
                            <td>{{$movie->duration}}</td>
                            <td>{{$movie->director}}</td>
                            <td width="10px">
{{--                                @can('admin.posts.edit')--}}
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.movies.edit', $movie)}}">Editar</a>
{{--                                @endcan--}}
                            </td>
                            <td width="10px">
{{--                                @can('admin.posts.destroy')--}}
                                    <form action="{{route('admin.movies.destroy', $movie)}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>
{{--                                @endcan--}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $movies->links() }}
        </div>

    @else
        <div class="card-body">
            <strong>No hay películas ...</strong>
        </div>

    @endif

</div>
