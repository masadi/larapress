<div>
    <div class="card">
        <div class="card-body">
            <form wire:ignore.self wire:submit.prevent="update">
            <table class="table">
                @foreach ($forms as $field => $attribut)
                <tr>
                    <td>{{$attribut['title']}}</td>
                    <td>
                        @if($showForm)
                            @if($attribut['type'] == 'text')
                                <input type="text" class="form-control" placeholder="{{$attribut['title']}}" aria-label="{{$attribut['title']}}" aria-describedby="{{$field}}" wire:model="{{$field}}">
                            @else
                            <div wire:ignore>
                                <select data-pharaonic="select2" id="{{$field}}" data-component-id="{{ $this->id }}" wire:model="{{$field}}" class="form-select" data-placeholder="== Pilih {{$attribut['title']}} ==">
                                    <option value="">== Pilih {{$attribut['title']}} ==</option>
                                    @foreach ($attribut['data'] as $item)
                                    <option value="{{$item->kode_wilayah}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        @else
                        : {{($yayasan) ? $yayasan->{$attribut['alias']} : ''}}
                        @endif
                        @error('{{$field}}') 
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </td>
                </tr>
                @endforeach
            </table>
            @if($showForm)
            <div wire:ignore>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-outline-danger" type="button" wire:click="showForm">Batal</button>
            </div>
            @else
            <button class="btn btn-outline-danger" type="button" wire:click="showForm">Edit</button>
            @endif
            </form>
        </div>
    </div>
    @include('components.loader')
</div>
@push('scripts')
<script>
    window.addEventListener('data_kabupaten', event => {
        $('#kabupaten').html('<option value="">== Pilih Kabupaten/Kota ==</option>')
        $('#kecamatan').html('<option value="">== Pilih Kecamatan ==</option>')
        $('#desa').html('<option value="">== Pilih Desa/Kelurahan ==</option>')
        $.each(event.detail.data_kabupaten, function (i, item) {
            $('#kabupaten').append($('<option>', { 
                value: item.kode_wilayah,
                text : item.nama
            }));
        });
    })
    window.addEventListener('data_kecamatan', event => {
        $('#kecamatan').html('<option value="">== Pilih Kecamatan ==</option>')
        $('#desa').html('<option value="">== Pilih Desa/Kelurahan ==</option>')
        $.each(event.detail.data_kecamatan, function (i, item) {
            $('#kecamatan').append($('<option>', { 
                value: item.kode_wilayah,
                text : item.nama
            }));
        });
    })
    window.addEventListener('data_desa', event => {
        $('#desa').html('<option value="">== Pilih Desa/Kelurahan ==</option>')
        $.each(event.detail.data_desa, function (i, item) {
            $('#desa').append($('<option>', { 
                value: item.kode_wilayah,
                text : item.nama
            }));
        });
    })
</script>
@endpush
