<div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="kementerian" class="form-label">Induk Kementerian</label>
                    <div wire:ignore>
                        <select class="form-select" wire:model="kementerian" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-parent="#addModal" data-placeholder="== Pilih Induk Kementerian ==">
                            <option value="">== Pilih Induk Kementerian ==</option>
                            <option value="1">Kemdikbud</option>
                            <option value="2">Kemenag</option>
                        </select>
                    </div>
                </div>
                @if($showPagi)
                <div class="mb-2">
                    <label for="kementerian" class="form-label">NPSN</label>
                    <input type="text" class="form-control" wire:model="npsn">
                </div>
                @endif
                @if($showSore)
                showSore
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Simpan</button>
            </div>
        </div>
    </div>
</div>