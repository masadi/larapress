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
                        <select class="form-select" wire:model="sekolah_id" wire:change="filterSekolah" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="== Filter Sekolah ==">
                            <option value="">== Filter Sekolah ==</option>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Lembaga</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Tingkat</th>
                        <th class="text-center">Wali Kelas</th>
                        <th class="text-center">Jml PD</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($collection as $item)
                    <tr>
                        <td>{{($item->sekolah) ? $item->sekolah->nama : '-'}}</td>
                        <td>{{$item->nama}}</td>
                        <td class="text-center">{{$item->tingkat_pendidikan_id}}</td>
                        <td>{{$item->ptk->nama}}</td>
                        <td class="text-center">{{$item->anggota_rombel_count}}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm dropstart">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" wire:click="getID('anggota', '{{$item->rombongan_belajar_id}}')">Anggota Rombel</a></li>
                                    <li><a class="dropdown-item" wire:click="getID('pembelajaran', '{{$item->rombongan_belajar_id}}')">Pembelajaran</a></li>
                                    <li><a class="dropdown-item" wire:click="getID('sync', '{{$item->rombongan_belajar_id}}')">Sync Pembelajaran</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="5">Tidak ada data untuk ditampilkan</td>
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
    @include('components.loader')
    @include('livewire.referensi.modal.pembelajaran')
    @include('livewire.referensi.modal.anggota')
</div>
@push('scripts')
<script>
    Livewire.on('modal-pembelajaran', event => {
        $('#pembelajaranModal').modal('show')
    })
    Livewire.on('modal-anggota', event => {
        $('#anggotaModal').modal('show')
    })
    Livewire.on('close-modal', event => {
        $('#pembelajaranModal').modal('hide')
        $('#anggotaModal').modal('hide')
    })
</script>
@endpush
