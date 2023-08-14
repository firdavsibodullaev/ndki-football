const Game = {
    teams: [],
    pairedTeams: [],
    modal: $('#game-modal'),
    seasonId: null,
    seasonConfig: {},
    setup() {
        this.seasonId = this.modal.attr('data-season-id');
        this.getSeasonInfo();
    },
    openModal() {
        this.getSeasonInfo();
        this.distributeTeamsByRound();
        this.addInputs();
        this.modal.modal('show');
    },
    getSeasonInfo() {
        if (!$.isEmptyObject(this.seasonConfig)) {
            return;
        }
        let config = {};

        $.ajax({
            url: `${location.origin}/admin/season/${this.seasonId}/show-json`,
            method: 'get',
            async: false,
            success(response) {
                config = response.data;
            }
        });

        this.teams = config.teams;
        this.seasonConfig = config;
        config = {};
    },
    distributeTeamsByRound() {

        if (this.pairedTeams.length > 0) {
            return;
        }

        const isHomeAway = this.seasonConfig.tournament.is_home_away;
        const distributedTeams = [];

        let pairedTeams = this.divideIntoGroupTeams(isHomeAway);
        let round = 1;

        while (pairedTeams.length > 0) {
            let gameOne = pairedTeams[0];
            let excludedIds = [gameOne.home.id, gameOne.away.id];
            pairedTeams.splice(0, 1);

            let gamesByRound = {
                round: round,
                games: [gameOne]
            };
            for (let i = 0; i < pairedTeams.length; i++) {
                let pairedTeam = pairedTeams[i];
                // console.log(pairedTeam.home.id, pairedTeam.away.id, excludedIds);
                if (excludedIds.includes(pairedTeam.home.id) || excludedIds.includes(pairedTeam.away.id)) {
                    continue;
                }
                excludedIds.push(pairedTeam.home.id, pairedTeam.away.id);
                gamesByRound.games.push(pairedTeam);

                pairedTeams.splice(pairedTeams.indexOf(pairedTeam), 1);
            }
            console.log("-----------------");
            distributedTeams.push(gamesByRound);
            round++;
        }
    },
    addInputs() {
        for (let i = 0; i < this.pairedTeams.length; i++) {
            let round = this.pairedTeams[i];
            let home = round.home;
            let away = round.away;
            // console.log(`${home.id} - ${away.id} | round: ${round.round}`);
        }
    },
    divideIntoGroupTeams(isHomeAway) {
        const pairedTeams = [];
        for (let i = 0; i < this.teams.length; i++) {

            let home = this.teams[i].team;
            let initialPoint = isHomeAway
                ? 0
                : i + 1;

            for (let j = initialPoint; j < this.teams.length; j++) {
                let away = this.teams[j].team;

                if (home.id === away.id) continue;

                pairedTeams.push({home, away});
            }
        }

        return pairedTeams;
    }
}

$(function () {
    Game.setup();
});
// 1 2 3 4 5 6 7 8

// 1-2 3-4 5-6 7-8
// 1-3 2-4 5-7 6-8
// 1-4 2-3 5-8 6-7
// 1-5 2-6 3-7 4-8
// 1-6 2-5 3-8 4-7
// 1-7 2-8 3-5 4-6
// 1-8 2-7 3-6 4-5


// n*(n-1)/2 8*7/2=
