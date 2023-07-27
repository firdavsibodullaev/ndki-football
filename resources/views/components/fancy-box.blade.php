<a data-src="{{ $url }}"
   data-fancybox="{{ $gallery }}"
   href="javascript:void(0)"
>
    <img src="{{ $url }}"
         style="{{ $css }}"
         alt="{{ $alt }}">
</a>
@pushonce('js')
    <script src="{{ asset('assets/plugins/fancybox/fancybox.js') }}"></script>
@endpushonce
@pushonce('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/fancybox.css') }}">
@endpushonce
