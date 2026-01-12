<?php

namespace App\Livewire\Catatan;

use App\Models\Catatan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Flux\Flux;
use Livewire\WithPagination;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    public $catatanId;

    protected $listeners = ['catatanUpdated' => '$refresh'];

    public function edit($id) 
    {
        $this->dispatch('edit-catatan', $id);
    }

    public function delete($id)
    {
        $this->catatanId = $id;
        Flux::modal('delete-catatan')->show();
    }

    public function render()
    {
        return view('livewire.catatan.index', [
            'catatans' => Catatan::latest()->paginate(5),
            'users'    => User::latest()->get() 
        ]);
    }

    public function createUser()
    {
        User::create([
            'name'      => 'Mamad',
            'email'     => 'Mamad@gmail.com',
            'password'  => Hash::make('password'),
        ]);
    }

    public function deleteCatatan()
    {
        Catatan::findOrFail($this->catatanId)->delete();
        Flux::modal('delete-catatan')->close();
        session()->flash('success', 'Catatan berhasil dihapus.');
    }
}