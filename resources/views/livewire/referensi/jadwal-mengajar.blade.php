<div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-2">
                <div class="col-4">
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="sekolah_id" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Sekolah ==">
                            <option value="">== Pilih Sekolah ==</option>
                            @foreach ($data_sekolah as $sekolah)
                            <option value="{{$sekolah->sekolah_id}}">{{$sekolah->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="rombongan_belajar_id" data-pharaonic="select2" id="rombongan_belajar_id" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Pilih Rombel ==">
                            <option value="">== Pilih Rombel ==</option>
                        </select>
                    </div>
                </div>
                <div class="col-4 d-grid">
                      
                </div>
            </div>
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                @foreach ($nama_hari as $hari)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{($active == $hari['urut']) ? 'active' : ''}}" id="pills-{{$hari['nama']}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$hari['nama']}}" type="button" role="tab" aria-controls="pills-{{$hari['nama']}}" {{($active == $hari['urut']) ? 'aria-selected="true"' : ''}} wire:click="getJadwal({{$hari['urut']}})">{{$hari['nama']}}</button>
                </li>      
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($nama_hari as $hari)
                <div class="tab-pane fade {{($active == $hari['urut']) ? 'show active' : ''}}" id="pills-{{$hari['nama']}}" role="tabpanel" aria-labelledby="pills-{{$hari['nama']}}-tab">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal" {{(!$rombongan_belajar_id) ? 'disabled' : ''}}>
                        Tambah Data
                    </button>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Jam Ke</th>
                                <th>Pembelajaran</th>
                                <th>Guru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($collection[$hari['urut']])
                            @foreach ($collection[$hari['urut']] as $item)
                            @isset($item->jam_ke)
                            <tr>
                                <td>{{$item->jam_ke}}</td>
                                <td>{{$item->pembelajaran->nama_mata_pelajaran}}</td>
                                <td>{{$item->pembelajaran->ptk->nama}}</td>
                                <td><button class="btn btn-sm btn-danger" type="button" wire:click="delete('{{$item->jadwal_mengajar_id}}')"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="4">Tidak ada data untuk ditampilkan</td>
                            </tr>
                            @endisset        
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
              
        </div>
    </div>
    @include('components.loader')
    @include('livewire.referensi.modal.add-jadwal')
</div>
@push('scripts')
<script>
    window.addEventListener('data_rombongan_belajar', event => {
        $('#rombongan_belajar_id').html('<option value="">== Pilih Rombongan Belajar ==</option>')
        $.each(event.detail.data_rombongan_belajar, function (i, rombongan_belajar) {
            $('#rombongan_belajar_id').append($('<option>', { 
                value: rombongan_belajar.rombongan_belajar_id,
                text : rombongan_belajar.nama
            }));
        });
    })
    window.addEventListener('pembelajaran', event => {
        console.log(event);
        $('#pembelajaran_id').html('<option value="">== Pilih Pembelajaran ==</option>')
        $.each(event.detail.pembelajaran, function (i, pembelajaran) {
            $('#pembelajaran_id').append($('<option>', { 
                value: pembelajaran.pembelajaran_id,
                text : pembelajaran.nama_mata_pelajaran
            }));
        });
    })
    Livewire.on('close-modal', event => {
        $('#addModal').modal('hide')
    })
</script>
@endpush
