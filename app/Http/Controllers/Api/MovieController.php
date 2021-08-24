<?php

namespace App\Http\Controllers\Api;

use App\Services\ImportMoviesService;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponder;
use Illuminate\Http\Request;

use App\Models\Movie;
use App\Rules\Api\MovieRules;


class MovieController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     *
     * @return \App\Http\Resources\Api\MovieResource
     */
    public function index(Request $request)
    {
        // Check for search argument.
        $title = $request->search ? $request->search : null;

        // Build query.
        $query = Movie::orderBy('id');
        if ($title) {
            $query->where('title', 'like', '%' . $title . '%' );
        }
        $movies = $query->paginate(5);

        return $this->successResponse( $movies, 'Retrieved.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Api\MovieResource
     */
    public function store(Request $request)
    {
        $this->validate($request, MovieRules::storeRules($request));

        $movie = Movie::create($request->all());

        return $this->successResponse( $movie, 'Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->notFoundResponse( $id );
        }

        return $this->successResponse( $movie, 'Retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, MovieRules::updateRules($request, $id));

        $movie = Movie::find($id);
        if (!$movie) {
            return $this->notFoundResponse( $id );
        }
        $movie->update($request->all());

        return $this->successResponse( $movie, 'Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $movie = Movie::find($id);
        if (!$movie) {
            return $this->notFoundResponse( $id );
        }
        $movie->delete();

        return $this->successResponse( $movie, 'Deleted.');

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

        return $this->successResponse( $affRows, $message);
    }

}
