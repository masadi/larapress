<div>
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <label for="sekolah_id" class="form-label">Unit Lembaga<span class="text-danger">*</span></label>
                <div wire:ignore>
                    <select class="form-select" wire:model="sekolah_id" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Unit Lembaga ==" >
                        <option value="">== Pilih Unit Lembaga ==</option>
                        <option value="yayasan">YAYASAN</option>
                        @foreach ($data_sekolah as $sekolah)
                        <option value="{{$sekolah->sekolah_id}}">{{$sekolah->nama}}</option>
                        @endforeach
                    </select>
                </div>
                @error('sekolah_id')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="nomor" class="form-label">Nomor Surat<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nomor" wire:model="nomor">
                @error('nomor')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="tanggal" class="form-label">Tanggal Surat<span class="text-danger">*</span></label>
                <div class="input-group ">
                    <span class="input-group-text" id="kalender"><i class="fas fa-calendar"></i> </span>
                    <input type="text" class="form-control" id="tanggal" wire:model="tanggal_str" aria-describedby="kalender" readonly>
                </div>
                @error('tanggal')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="perihal" class="form-label">Perihal<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="perihal" wire:model="perihal">
                @error('perihal')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="tujuan" class="form-label">Tujuan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tujuan" wire:model="tujuan">
                @error('tujuan')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="bentuk_surat" class="form-label">Bentuk Surat<span class="text-danger">*</span></label>
                <div wire:ignore>
                    <select class="form-select" wire:model="bentuk_surat" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Bentuk Surat ==" >
                        <option value="">== Pilih Bentuk Surat ==</option>
                        <option value="file">File (JPEG/JPG/PDF)</option>
                        <option value="template">Template</option>
                        <option value="blank">Blank</option>
                    </select>
                </div>
                @error('bentuk_surat')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label for="berkas" class="form-label">Berkas</label>
                <input type="file" class="form-control" id="berkas" wire:model="berkas">
            </div>
            
            {{--
            <div class="mb-2">
                <label for="template" class="form-label">Template Surat</label>
                <div wire:ignore>
                    <select class="form-select" wire:model="template" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Template Surat ==" >
                        <option value="">== Pilih Template Surat ==</option>
                        <option value="undangan">Surat Undangan</option>
                        <option value="ska">Surat Keterangan Aktif</option>
                        <option value="edaran">Surat Edaran</option>
                    </select>
                </div>
            </div>
            --}}
            <div class="mb-2">
                <label for="content" class="form-label">Isi Surat</label>
                <div wire:ignore>
                    <textarea wire:model.debounce.2000ms="content" class="form-control" name="content" id="content">{{$content}}</textarea>
                </div>
                @error('content')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:click.prevent="store()">Simpan</button>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    picker = new Pikaday({
        field: document.getElementById('tanggal'),
        format: 'LL',
        minDate: new Date(),
        maxDate: new Date(2020, 12, 31),
        onSelect: function() {
            startDate = this.getDate();
            Livewire.emit('setTanggal', startDate)
        },
        i18n: {
            previousMonth : 'Previous Month',
            nextMonth     : 'Next Month',
            months        : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            weekdays      : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
            weekdaysShort : ['Min','Sen','Sel','Rab','Kam','Jum','Sab']
        }
    })
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
    Livewire.on('changeContent', event => {
        $('#content').val(event.content)
        //@this.set('content', event.content);
    })
</script>
@endpush
