<div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between mb-2">
                <div class="col-4">
                    <div class="d-inline">
                        <select class="form-select" wire:model="per_page" wire:change="loadPerPage">
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
                        <th class="text-center">Sekolah</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_ptk as $ptk)
                    <tr>
                        <td>{{$ptk->sekolah->nama}}</td>
                        <td>{{$ptk->nama}}</td>
                        <td>{{$ptk->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-between mt-2">
                <div class="col-4">
                    <p>Showing {{ $data_ptk->firstItem() }} to {{ $data_ptk->firstItem() + $data_ptk->count() - 1 }} of {{ $data_ptk->total() }} items</p>
                </div>
                <div class="col-4">
                    {{ $data_ptk->links('components.custom-pagination-links-view') }}
                </div>
            </div>
        </div>
    </div>
</div>
