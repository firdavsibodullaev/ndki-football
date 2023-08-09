<div class="modal fade" id="game-modal">
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
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="started_at">{{ __('Дата первого матча') }}</label>
                                <input type="date"
                                       class="form-control"
                                       id="started_at"
                                       name="started_at"
                                       value="{{ $season->started_at->format('Y-m-d') }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="finished_at">{{ __('Дата последнего матча') }}</label>
                                <input type="date"
                                       class="form-control"
                                       id="finished_at"
                                       name="finished_at"
                                       value="{{ $season->finished_at->format('Y-m-d') }}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="days">{{ __('Дни проведения матчей') }}</label>
                        <select name="days[]"
                                id="days"
                                multiple
                                required
                                data-placeholder="{{ __('Выберите дни проведения матчей') }}"
                                class="select2 w-100">
                            <option value=""></option>
                            <option value="1">{{ __('Понедельник') }}</option>
                            <option value="2">{{ __('Вторник') }}</option>
                            <option value="3">{{ __('Среда') }}</option>
                            <option value="4">{{ __('Четверг') }}</option>
                            <option value="5">{{ __('Пятница') }}</option>
                            <option value="6">{{ __('Суббота') }}</option>
                            <option value="7">{{ __('Воскресенье') }}</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Закрыть') }}</button>
                <button type="button"
                        class="btn btn-primary"
                        onclick="document.querySelector('#game-store-form').submit()">
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
@endpushonce
