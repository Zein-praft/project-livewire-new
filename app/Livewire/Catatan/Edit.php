<?php

namespace App\Livewire\Catatan;

use App\Models\Catatan;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $catatanId;
    public $judul;
    public $isi;

    #[On('edit-catatan')]
    public function edit($id)
    {
        $catatan = Catatan::findOrFail($id);
        $this->catatanId = $catatan->id;
        $this->judul = $catatan->judul;
        $this->isi = $catatan->isi;
        Flux::modal('edit-catatan')->show();
    }

    public function update()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        Catatan::where('id', $this->catatanId)->update([
            'judul' => $this->judul,
            'isi'   => $this->isi,
        ]);

        Flux::modal('edit-catatan')->close();
        session()->flash('success', 'Catatan berhasil diperbarui.');

        // 🔥 Kirim event ke komponen utama (Index)
        $this->dispatch('catatanUpdated');
    }

    public function render()
    {
        return view('livewire.catatan.edit');
    }
}