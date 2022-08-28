<div>
    <form wire:submit.prevent="store">
        <div class="row match-height">
            <div class="col-xl-8 col-md-7 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <input type="text" class="form-control" wire:model.defer="title" placeholder="Judul Halaman">
                        </div>
                        <div class="mb-2" id="full-container" wire:ignore>
                            <div class="editor" style="height: 375px;"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Gambar Utama</h5>
                        <input class="form-control" type="file" id="formFile" wire:model.defer="gambar">
                        <h5 class="mt-2">Kategori</h5>
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model.defer="cats" id="{{$category->id}}" value="{{$category->id}}">
                                <label class="form-check-label" for="{{$category->id}}">
                                    {{$category->name}}
                                </label>
                            </div>
                        @endforeach
                        <p><a href="javascript:void(0)" wire:click="tambahKategori">Tambah Kategori</a></p>
                        @if ($showDiv)
                        <input type="text" class="form-control" wire:model.defer="kategori">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}" />
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
<script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script src="{{ asset('vendor/pharaonic/pharaonic.tagify.min.js') }}"></script>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    var quill = new Quill('.editor', {
        bounds: '.editor',
        modules: {
            formula: true,
            syntax: true,
            toolbar: [
                [
                {
                    font: []
                },
                {
                    size: []
                }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [
                {
                    color: []
                },
                {
                    background: []
                }
                ],
                [
                {
                    script: 'super'
                },
                {
                    script: 'sub'
                }
                ],
                [
                {
                    header: '1'
                },
                {
                    header: '2'
                },
                'blockquote',
                'code-block'
                ],
                [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                },
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
                ],
                [
                'direction',
                {
                    align: []
                }
                ],
                [
                    'link', 
                    'image',
                    'video', 
                    'formula'
                ],
                ['clean']
            ]
        },
        theme: 'snow'
    });
    let content = (function () {
        try {
            return '$content';
        } catch (e) {
            return {};
        }
    })();
    quill.setContents(content);
    quill.on('text-change', function (){
        @this.set('content', quill.container.firstChild.innerHTML);
    })
    function selectLocalImage() {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.click();

        // Listen upload local image and save to server
        input.onchange = () => {
            const file = input.files[0];
            // file type is only image.
            if (/^image\//.test(file.type)) {
                saveToServer(file);
            } else {
                console.warn('You could only upload images.');
            }
        };
    }
    /**
     * * Step2. save to server
     * *
     * * @param {File} file
     * */
    function saveToServer(file) {
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('gambar', reader.result);
        }
        reader.readAsDataURL(file);
    }
    /**
     * * Step3. insert image url to rich editor.
     * *
     * * @param {string} url
     * */
    Livewire.on('image_url', data => {
        insertToEditor(data.data)
    })
    function insertToEditor(url) {
        const range = quill.getSelection();
        quill.insertEmbed(range.index, 'image', `${url}`);
    }
    // quill editor add image handler
    quill.getModule('toolbar').addHandler('image', () => {
        selectLocalImage();
    });
});
</script>
@endpush