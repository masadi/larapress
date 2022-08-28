<div wire:ignore.self class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Buat Surat Keluar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-2">
                    <label for="sekolah_id" class="form-label">Unit Lembaga</label>
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="sekolah_id" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Unit Lembaga ==" data-parent="#addModal">
                            <option value="">== Pilih Unit Lembaga ==</option>
                            <option value="yayasan">YAYASAN</option>
                            @foreach ($data_sekolah as $sekolah)
                            <option value="{{$sekolah->sekolah_id}}">{{$sekolah->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="nomor" class="form-label">Nomor Surat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nomor" wire:model="nomor">
                </div>
                <div class="mb-2">
                    <label for="tanggal" class="form-label">Tanggal Surat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tanggal" wire:model="tanggal_str" readonly>
                </div>
                <div class="mb-2">
                    <label for="perihal" class="form-label">Perihal<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="perihal" wire:model="perihal">
                </div>
                <div class="mb-2">
                    <label for="tujuan" class="form-label">Tujuan<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tujuan" wire:model="tujuan">
                </div>
                <div class="mb-2">
                    <label for="bentuk_surat" class="form-label">Bentuk Surat<span class="text-danger">*</span></label>
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="bentuk_surat" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Bentuk Surat ==" data-parent="#addModal">
                            <option value="">== Pilih Bentuk Surat ==</option>
                            <option value="file">File (JPEG/JPG/PDF)</option>
                            <option value="template">Template</option>
                            <option value="blank">Blank</option>
                        </select>
                    </div>
                </div>
                @if($bentuk_surat == 'file')
                <div class="mb-2">
                    <label for="berkas" class="form-label">Berkas</label>
                    <input type="file" class="form-control" id="berkas" wire:model="berkas">
                </div>
                @endif
                @if($bentuk_surat == 'template')
                <div class="mb-2">
                    <label for="template" class="form-label">Template Surat</label>
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="template" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Template Surat ==" data-parent="#addModal">
                            <option value="">== Pilih Template Surat ==</option>
                            <option value="undangan">Surat Undangan</option>
                            <option value="ska">Surat Keterangan Aktif</option>
                            <option value="edaran">Surat Edaran</option>
                        </select>
                    </div>
                </div>
                @endif
                @if($bentuk_surat == 'blank')
                <div class="mb-2">
                    <label for="berkas" class="form-label">Berkas</label>
                    <div id="full-container" wire:ignore>
                        <div class="editor"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Simpan</button>
            </div>
        </div>
    </div>
</div>