const MatchGoals = {
    seasonId: null,
    gameId: null,
    game: null,
    modal: $("#match-goals"),
    form: $("#match_goals_form"),
    openModal(seasonId, gameId) {
        this.seasonId = seasonId;
        this.gameId = gameId;
        this.loadGame();
        this.putValuesToHtml();
        this.modal.modal('show');
    },
    loadGame() {
        if (this.game) {
            return;
        }

        $.ajax({
            url: `${location.origin}/admin/season/${this.seasonId}/game/${this.gameId}/json`,
            method: 'get',
            async: false,
            success: ({data}) => this.game = data
        });
    },
    putValuesToHtml() {
        $('#home_team_name').text(this.game.home.season_team.team.name);
        $('#home_team_goals').val(this.game.home.goals);

        $('#away_team_name').text(this.game.away.season_team.team.name);
        $('#away_team_goals').val(this.game.away.goals);
    },
    submitForm() {
        const baseAction = this.form.attr('data-action');
        let action = baseAction.replace('ID0', this.seasonId).replace('ID1', this.gameId);
        this.form.attr('action', action);
        this.form.submit();
    }
}
