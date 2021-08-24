<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Movie;

use Livewire\WithPagination;

class MoviesIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $movies = Movie::where('title', 'like', '%' . $this->search . '%')
            ->paginate(5);

        return view('livewire.admin.movies-index', compact('movies'));
    }
}
