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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($collection as $item)
                    <tr>
                        <td>{{$item->nama}}</td>
                        <td>{{($item->periode_aktif) ? 'Ya' : 'Tidak'}}</td>
                        <td>
                            <div class="form-check form-switch text-center">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" {{($item->periode_aktif) ? 'checked' : ''}} wire:change="aktifkan('{{$item->semester_id}}')">
                            </div>
                            {{-- 
                            ($item->periode_aktif) ? 'Aktifkan' : '-'
                            --}}
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
</div>