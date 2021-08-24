<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;                 // reconose que viene un campo con un string de búsqueda.

    protected $paginationTheme = 'bootstrap';

    // Este método se activa cuando cambia el valor de la propiedad "$search"
    // entonce, resetea la información de la paginación para que vuelva a
    // la página 1.
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->paginate();
        return view('livewire.admin.users-index', compact('users'));
    }
}
