<div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                            <select class="form-select" wire:model="role_id" wire:change="filterAkses" data-pharaonic="select2" data-component-id="{{ $this->id }}" data-search-off="true" data-placeholder="-- Filter Hak Akses --">
                                <option value="">-- Filter Hak Akses --</option>
                                @foreach($hak_akses as $akses)
                                <option value="{{$akses->name}}">{{$akses->display_name}}</option>
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
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Jenis Pengguna</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collection as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                {{$user->roles->unique()->implode('display_name', ', ')}}
                            </td>
                            <td>{{$user->last_login_at}}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <li><a class="dropdown-item" wire:click="view('{{$user->user_id}}')"><i data-feather="eye"></i> Detil</a></li>
                                        <li><a class="dropdown-item" wire:click="destroy('{{$user->user_id}}')"><i data-feather="trash-2"></i> Hapus</a></li>
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
    @include('livewire.users.add')
    @include('livewire.users.edit')
</div>
@push('scripts')
<script>
    Livewire.on('openView', event => {
        $('#editModal').modal('show');
    })
    Livewire.on('close-modal', event => {
        $('#editModal').modal('hide');
    })
</script>
@endpush
