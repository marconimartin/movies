<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;


class ImportMoviesService
{
    protected $affRows = 0;
    protected $message = '';

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Request;
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) : void
    {

        $this->affRows = $this->importMovies($request);

        // Message to show.
        if ($this->affRows == 1) {
            $this->message = 'Se importó '    . $this->affRows . ' película.';
        } else {
            $this->message = 'Se importaron ' . $this->affRows . ' películas.';
        }

    }

    /**
     * Returns a message about the number of imported movies.
     *
     * @return string
     */
    public function getMessage ( ) : string
    {
        // Message to show.
        if ($this->affRows == 1) {
            $this->message = 'Se importó '    . $this->affRows . ' película.';
        } else {
            $this->message = 'Se importaron ' . $this->affRows . ' películas.';
        }
        return $this->message;
    }

    //------------------------------------------------------------------------------------------------------------------
    // Private functions
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Upload received file and import new movies records.
     *
     * @param $requst
     * @return int $affRows
     */
    private function importMovies($request): int
    {
        $affRows = 0;

        if ($request->file) {

            // Upload file to a 'imports' folder under storage.
            $filePath = Storage::put('imports', $request->file('file'));   // something like "imports/Z0HU...C1kA.txt"
            $fullPath = storage_path() . '/app/public/' . $filePath;

            // Read file and convert it to array (one element per line).
            $lines = $this->readCSV($fullPath, array('delimiter' => ','));

            // Proccess lines (Movies)
            foreach ($lines as $line) {
                if (!$line) continue;                   // Empty line.

                // Get movie information
                $columns = [
                    'title' => trim($line[0]),
                    'duration' => $line[1],
                    'director' => $line[2],
                ];

                // Check if movie exists (by title)
                $movie = Movie::where('title', $columns['title'])->first();

                // Insert new movie.
                if (!$movie) {
                    $movie = Movie::create($columns);
                    if ($movie) {
                        $affRows++;
                    }
                }
            }

            // Delete processed file.
            $success = Storage::delete($filePath);
        }

        return $affRows;

    }

    /**
     * Read a file content and convert it in array (one element per line). Each line
     * another array (of columns).
     *
     * @param string $csvFile
     * @param array $options
     * @return array $lines
     */
    private function readCSV(string $csvFile, array $options): array
    {
        $lines = [];

        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $lines[] = fgetcsv($file_handle, 0, $options['delimiter']);
        }
        fclose($file_handle);

        return $lines;
    }

}
