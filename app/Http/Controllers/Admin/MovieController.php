<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImportMoviesService;
use Illuminate\Http\Request;

use App\Models\Movie;
use App\Http\Requests\MovieRequest;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminlte.movies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlte.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MovieRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $movie = Movie::create($request->all());

        return redirect()->route('admin.movies.edit', $movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('adminlte.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MovieRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());

        return redirect()->route('admin.movies.edit', $movie)->with('info', 'Película actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('info', 'Película borrada.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importCreate()
    {
        return view('adminlte.movies.import-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Request;         // Al tipar el request fuerza a usar las reglas de validación de la clase.
     * @return \Illuminate\Http\Response
     */
    public function importStore(Request $request)
    {

        $iService = new ImportMoviesService();
        $affRows = $iService->import($request);
        $message = $iService->getMessage();

        return redirect()->route('admin.movies.index')->with('info', $message);
    }
}
