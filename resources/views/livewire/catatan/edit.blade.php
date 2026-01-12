<div>
    <flux:modal name="edit-catatan" class="md:w-900">
        <div>
            <flux:heading size="lg">Edit Catatan</flux:heading>
            <flux:text class="mt-2">Make changes to your catatan details.</flux:text>
        </div>

        {{-- 🔥 Bungkus dengan form --}}
        <form wire:submit.prevent="update" class="space-y-4 mt-4">
            <flux:input 
                label="Judul" 
                wire:model="judul" 
                placeholder="Masukkan Judul Catatan" {{-- ✅ typo diperbaiki --}}
            />
            
            <flux:textarea 
                label="Isi" 
                wire:model="isi" 
                placeholder="Masukkan Isi Catatan"
            />

            <div class="flex justify-end gap-3 pt-4">
                <flux:button type="button" variant="ghost" wire:click="$dispatch('close-modal', { name: 'edit-catatan' })">
                    Batal
                </flux:button>
                <flux:button type="submit" variant="primary">
                    Simpan Perubahan
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>