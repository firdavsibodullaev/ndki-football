<div class="form-group">
    <label for="{{ $id }}">{{ $text }}</label>
    <input type="file"
           class="form-control-file"
           name="{{ $name }}"
           id="{{ $id }}"
           data-file="{{ $file?->getFullUrl() }}"
           onchange="imagePreview(this)"
           @required($isRequired)
           accept="image/svg+xml,image/jpeg, image/jpg, image/png">

    <div @class(['d-none' => !$file, 'preview-block mt-3'])>
        <x-fancy-box :url="$file?->getFullUrl()"
                     :alt="$file?->file_name"
                     :css="'width: 300px; object-fit: contain; aspect-ratio: 1'"
                     :gallery="'team-logo'"/>
    </div>
</div>
@pushonce('js')
    <script src="{{ asset('assets/dist/js/image-input.js') }}"></script>
@endpushonce
