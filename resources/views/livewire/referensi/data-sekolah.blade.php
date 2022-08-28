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
                    <input type="text" class="form-control" placeholder="Cari data..." wire:model="search">
                </div>
            </div>
            <div class="table-responsive-salah">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">NPSN</th>
                            <th class="text-center">PTK</th>
                            <th class="text-center">ROMBEL</th>
                            <th class="text-center">PD</th>
                            <th class="text-center">Sync Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collection as $item)
                        <tr>
                            <td>{{$item->nama}}</td>
                            <td class="text-center">{{$item->npsn}}</td>
                            <td class="text-center">{{$item->ptk_count}}</td>
                            <td class="text-center">{{$item->rombongan_belajar_count}}</td>
                            <td class="text-center">{{$item->peserta_didik_count}}</td>
                            <td class="text-center">
                                <!--div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-danger" wire:click="syncData('ptk', '{{$item->sekolah_id}}')">PTK</button>
                                    <button type="button" class="btn btn-warning" wire:click="syncData('rombongan_belajar', '{{$item->sekolah_id}}')">Rombel</button>
                                    <button type="button" class="btn btn-success" wire:click="syncData('peserta_didik_aktif', '{{$item->sekolah_id}}')">PD</button>
                                </div-->
                                <div class="btn-group btn-group-sm dropstart">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sinkronisasi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" wire:click="syncData('ptk', '{{$item->sekolah_id}}')">PTK</a></li>
                                        <li><a class="dropdown-item" wire:click="syncData('rombongan_belajar', '{{$item->sekolah_id}}')">Rombel</a></li>
                                        <li><a class="dropdown-item" wire:click="syncData('peserta_didik_aktif', '{{$item->sekolah_id}}')">Peserta Didik</a></li>
                                        <li><a class="dropdown-item" wire:click="syncData('ekstrakurikuler', '{{$item->sekolah_id}}')">Ekstrakurikuler</a></li>
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
    </div>
    @include('components.loader')
    @include('livewire.referensi.modal.add-sekolah')
    @include('livewire.referensi.modal.edit-sekolah')
</div>
@push('scripts')
<script>
    Livewire.on('close-modal', event => {
        $('#addModal').modal('hide')
    })
</script>
@endpush