<div class="modal fade" id="game-modal" data-season-id="{{ $season->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Распределение матчей') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.season.game.store', $season->id) }}"
                      method="post"
                      id="game-store-form"
                      autocomplete="off">
                    @csrf
                    <div id="game-store-round-select-block"></div>
                    <div id="game-store-selects-block"></div>
                    <div id="game-store-inputs-block"></div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Закрыть') }}</button>
                <button type="button"
                        class="btn btn-primary"
                        onclick="Game.submitForm()">
                    {{ __('Сохранить') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@pushonce('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpushonce
@pushonce('js')
    <script src="{{ asset('assets/dist/js/game-modal.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
    @if($errors->any())
        <script>
            Game.ids = @json(old('game'));
        </script>
    @endif
@endpushonce
