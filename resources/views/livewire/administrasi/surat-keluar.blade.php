<div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-2">
                <div class="col-4">
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="per_page" wire:change="loadPerPage" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-inline" wire:ignore>
                        <select class="form-select" wire:model="filter_sekolah" wire:change="filterSekolah" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Filter Unit Lembaga ==">
                            <option value="">== Filter Unit Lembaga ==</option>
                            <option value="yayasan">YAYASAN</option>
                            @foreach ($data_sekolah as $sekolah)
                            <option value="{{$sekolah->sekolah_id}}">{{$sekolah->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Cari data..." wire:model="search">
                </div>
            </div>
            <div class="table-responsive-salah">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Unit Lembaga</th>
                            <th class="text-center">Tujuan</th>
                            <th class="text-center">Perihal</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collection as $item)
                        <tr>
                            <td>{{($item->sekolah) ? $item->sekolah->nama : 'YAYASAN'}}</td>
                            <td>{{$item->tujuan}}</td>
                            <td>{{$item->perihal}}</td>
                            <td class="text-center">{{$item->tanggal}}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm dropstart">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" wire:click="getID('detil', '{{$item->surat_keluar_id}}')"><i class="fas fa-eye"></i> Detil</a></li>
                                        <li><a class="dropdown-item" wire:click="getID('edit', '{{$item->surat_keluar_id}}')"><i class="fas fa-pencil"></i> Edit</a></li>
                                        <li><a class="dropdown-item" wire:click="getID('hapus', '{{$item->surat_keluar_id}}')"><i class="fas fa-trash"></i> Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">Tidak ada data untuk ditampilkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row justify-content-between mt-2">
                    <div class="col-4">
                        @if($collection->count())
                        <p>Menampilkan {{ $collection->firstItem() }} sampai {{ $collection->firstItem() + $collection->count() - 1 }} dari {{ $collection->total() }} data</p>
                        @endif
                    </div>
                    <div class="col-4">
                        {{ $collection->onEachSide(1)->links('components.custom-pagination-links-view') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.loader')
    @include('livewire.administrasi.modal.add-surat-keluar')
    @include('livewire.administrasi.modal.edit-surat-keluar')
    @include('livewire.administrasi.modal.detil-surat-keluar')
</div>
@push('scripts')
<script>
    Livewire.on('close-modal', event => {
        $('#addModal').modal('hide')
        $('#editModal').modal('hide')
        $('#detilModal').modal('hide')
    })
    Livewire.on('edit-modal', event => {
        $('#editModal').modal('show')
    });
    Livewire.on('detil-modal', event => {
        $('#detilModal').modal('show')
    });
</script>
@endpush