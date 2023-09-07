<div class="modal fade" id="match-goals">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Матч') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{ __('Счёт') }}</h4>
                <form action=""
                      data-action="{{ route('admin.season.game.save_score', ['season' => 'ID0', 'game' => 'ID1']) }}"
                      id="match_goals_form"
                      method="post">
                    @csrf
                    @method('patch')
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <span class="text-lg" id="home_team_name"></span>
                        </div>
                        <div class="col-6 mb-3">
                            <span class="text-lg" id="away_team_name"></span>
                        </div>
                        <div class="col-6">
                            <div class="form-group d-flex justify-content-center">
                                <input type="text"
                                       id="home_team_goals"
                                       name="home_goal"
                                       class="text-center form-control w-50">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group d-flex justify-content-center">
                                <input type="text"
                                       id="away_team_goals"
                                       name="away_goal"
                                       class="text-center form-control w-50">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Закрыть') }}</button>
                <button type="button"
                        class="btn btn-primary"
                        onclick="MatchGoals.submitForm()">
                    {{ __("Сохранить") }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@pushonce('js')
    <script src="{{ asset('assets/dist/js/match-goals.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpushonce
