<div class="modal fade" id="season-team-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Список команд') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.season.team.store', $season->id) }}"
                      method="post"
                      id="season-team-form"
                      enctype="multipart/form-data">
                    @csrf
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>
                                <div class="icheck-primary">
                                    <input type="checkbox"
                                           id="season-team-modal-all-selected"
                                           onclick="SeasonTeam.allSelected(this)"
                                           checked>
                                    <label for="season-team-modal-all-selected"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>{{ __('Лого') }}</th>
                            <th>{{ __('Название') }}</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Закрыть') }}</button>
                <button type="button"
                        class="btn btn-primary"
                        onclick="document.querySelector('#season-team-form').submit()">
                    {{ __('Добавить') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@pushonce('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpushonce
@pushonce('js')
    <script src="{{ asset('assets/plugins/fancybox/fancybox.js') }}"></script>
    <script src="{{ asset('assets/dist/js/season-team-modal.js') }}"></script>
@endpushonce
