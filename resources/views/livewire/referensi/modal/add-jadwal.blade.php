<div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Jadwal <strong>{{$nama_kelas}}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="Pembelajaran" class="form-label">Pembelajaran</label>
                    <div wire:ignore>
                        <select class="form-select" wire:model="pembelajaran_id" id="pembelajaran_id" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-parent="#addModal" data-placeholder="== Pilih Pembelajaran ==">
                            <option value="">== Pilih Pembelajaran ==</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="alokasi" class="form-label">Alokasi Jam</label>
                    <input type="number" class="form-control" wire:model="alokasi">
                </div>
                <div class="mb-2">
                    <label for="jam_ke" class="form-label">Jam Ke</label>
                    <input type="number" class="form-control" wire:model="jam_ke">
                </div>
                @error('pembelajaran_id')
                    <span class="text-danger">{!! $message !!}</span>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Simpan</button>
            </div>
        </div>
    </div>
</div>