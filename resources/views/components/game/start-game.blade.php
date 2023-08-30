<div class="modal fade" id="game-start-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Старт матча') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.season.game.start',[$game->season_id, $game->id]) }}"
                      id="game-start-form"
                      method="post">
                    @csrf
                    @method('patch')
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h5 class="card-title">{{ __('Стартовый состав') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 text-center border-right">
                                    <h4 class="border-bottom mb-3"><strong>{{ $game->home->team->name }}</strong></h4>
                                    @foreach($game->home->team->players as $player)
                                        <input type="hidden"
                                               value="{{ $game->home_id }}"
                                               name="game[home][team_id]">
                                        <input type="hidden"
                                               name="game[home][players][{{ $loop->iteration - 1 }}][player_id]"
                                               value="{{ $player->id }}">
                                        <h5 class="border shadow-sm py-2 px-4 position-relative">
                                            <div class="icheck-primary position-absolute"
                                                 style="left: 1.5rem; top: 0.2rem">
                                                <input type="checkbox"
                                                       name="game[home][players][{{ $loop->iteration - 1 }}][on_start]"
                                                       id="game-start-home-players-{{ $loop->iteration }}"
                                                       @checked($loop->iteration <= 11)
                                                       value="1">
                                                <label for="game-start-home-players-{{ $loop->iteration }}"></label>
                                            </div>
                                            {{ $player->name_initials }}
                                            <span class="ml-4 position-absolute"
                                                  style="right: 1.5rem">{{ $player->number }}
                                            </span>
                                        </h5>
                                    @endforeach
                                </div>
                                <div class="col-6 text-center border-left">
                                    <h4 class="border-bottom mb-3"><strong>{{ $game->away->team->name }}</strong></h4>
                                    @foreach($game->away->team->players as $player)
                                        <input type="hidden"
                                               value="{{ $game->away_id }}"
                                               name="game[away][team_id]">
                                        <input type="hidden"
                                               name="game[away][players][{{ $loop->iteration - 1 }}][player_id]"
                                               value="{{ $player->id }}">
                                        <h5 class="border shadow-sm py-2 px-4 position-relative">
                                            <span class="mr-4 position-absolute"
                                                  style="left:1.5rem">{{ $player->number }}
                                            </span>
                                            {{ $player->name_initials }}
                                            <div class="icheck-primary position-absolute"
                                                 style="right: 1.5rem; top: 0.2rem">
                                                <input type="checkbox"
                                                       name="game[away][players][{{ $loop->iteration - 1 }}][on_start]"
                                                       @checked($loop->iteration <= 11)
                                                       id="game-start-away-players-{{ $loop->iteration }}"
                                                       value="1">
                                                <label for="game-start-away-players-{{ $loop->iteration }}"></label>
                                            </div>
                                        </h5>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Закрыть') }}</button>
                <button type="button"
                        class="btn btn-primary"
                        onclick="GameStart.submitForm()">
                    {{ __("Начать матч") }}
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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/game-start.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpushonce
