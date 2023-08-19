const Game = {
    teams: [],
    gamesByRound: [],
    rounds: 0,
    gamesNumberByRound: 0,
    modal: $('#game-modal'),
    seasonId: null,
    seasonConfig: {},
    setup() {
        this.seasonId = this.modal.attr('data-season-id');
        this.getSeasonInfo();
    },
    openModal() {
        this.getSeasonInfo();
        this.render();
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

        this.seasonConfig = config;
        this.teams = config.teams;
        this.rounds = (this.teams.length - 1) * (config.tournament.is_home_away ? 2 : 1);
        this.gamesNumberByRound = this.teams.length / 2;
        config = {};
    },
    render() {
        if (this.teams.length === 0) {
            this.getSeasonInfo();
        }

        const select = this.renderSelect();

        this.modal.find('#game-store-round-select-block').html(select);
        const inputBlock = this.modal.find('#game-store-inputs-block');
        inputBlock.html('');

        initSelect2();
    },
    renderSelect() {
        const block = $('<div>', {
            class: 'form-group'
        });
        const label = $('<label>', {
            for: 'season-round',
            text: 'Туры'
        });
        const select = $('<select>', {
            onchange: 'Game.getPairedTeamInputs(this)',
            class: 'select2 w-100',
            'data-placeholder': 'Выберите тур',
            id: 'season-round'
        });
        const option = $('<option>');
        select.append(option);

        for (let i = 0; i < this.rounds; i++) {
            select.append(
                $('<option>', {
                    value: i + 1,
                    text: i + 1
                })
            );
        }

        return block.append(label).append(select);
    },
    getPairedTeamInputs(el) {
        const $this = $(el);
        const roundNumber = +$this.val();
        const round = this.getRound(roundNumber);
        const inputBlock = this.modal.find('#game-store-inputs-block');
        inputBlock.html('');
        for (let i = 0; i < this.gamesNumberByRound; i++) {
            let game = round.games[i];
            let row = $('<div>', {class: 'row'});
            let index = this.gamesNumberByRound * (roundNumber - 1) + i;

            let col41 = $('<div>', {class: 'col-4'});
            let homeSelectBlock = $('<div>', {class: 'form-group'});
            let homeSelectLabel = $('<label>', {for: `home-select-${roundNumber}-${i}`, text: 'Команда'});
            let homeSelect = $('<select>', {
                onchange: `Game.addTeamToGamesByRoundList(this, ${roundNumber}, ${i}, 'home')`,
                name: `game[${index}][home]`,
                class: 'select2 w-100',
                'data-placeholder': 'Выберите команду',
                id: `home-select-${roundNumber}-${i}`
            });

            let col4 = $('<div>', {class: 'col-4'});
            let dateBlock = $('<div>', {class: 'form-group'});
            let dateLabel = $('<label>', {for: `date-input-${roundNumber}-${i}`, text: 'Дата'});
            let dateInput = $('<input>', {
                onchange: `Game.addDateToGamesByRoundList(this, ${roundNumber}, ${i})`,
                id: `date-input-${roundNumber}-${i}`,
                class: 'form-control',
                type: 'date',
                value: game?.date,
                name: `game[${index}][date]`
            });

            let col42 = $('<div>', {class: 'col-4'});
            let awaySelectBlock = $('<div>', {class: 'form-group'});
            let awaySelectLabel = $('<label>', {for: `away-select-${roundNumber}-${i}`, text: 'Команда'});
            let awaySelect = $('<select>', {
                onchange: `Game.addTeamToGamesByRoundList(this, ${roundNumber}, ${i}, 'away')`,
                name: `game[${index}][away]`,
                class: 'select2 w-100',
                'data-placeholder': 'Выберите команду',
                id: `away-select-${roundNumber}-${i}`
            });
            this.setTeamOptions(homeSelect, game?.home);
            this.setTeamOptions(awaySelect, game?.away);
            col41.append(homeSelectBlock.append(homeSelectLabel).append(homeSelect));
            col4.append(dateBlock.append(dateLabel).append(dateInput));
            col42.append(awaySelectBlock.append(awaySelectLabel).append(awaySelect));
            row.append(col41).append(col4).append(col42);
            inputBlock.append(row);

            initSelect2();
        }
    },
    setTeamOptions(select, selectedTeam) {
        select.append($('<option>'));
        for (let i = 0; i < this.teams.length; i++) {
            let team = this.teams[i];
            let option = $('<option>', {
                value: team.id,
                text: team.team.name,
                selected: selectedTeam?.id === team.id
            });
            select.append(option);
        }
    },
    addTeamToGamesByRoundList(el, round, gameNumber, key) {
        const $this = $(el);
        const id = +$this.val();
        let team = this.teams.filter((team) => team.id === id)[0];
        let gameOfRound = this.gamesByRound[round - 1].games[gameNumber];

        if (gameOfRound === undefined) {
            this.gamesByRound[round - 1].games.push({
                [key]: team
            });
        } else {
            this.gamesByRound[round - 1].games[gameNumber][key] = team;
        }
    },
    getRound(round) {
        let gamesOfRound = this.gamesByRound.filter((game) => game.round === round);
        if (gamesOfRound.length === 0) {
            gamesOfRound = {round: round, games: []};
            this.gamesByRound.push(gamesOfRound);
        } else {
            gamesOfRound = gamesOfRound[0];
        }

        return gamesOfRound;
    }
}

$(function () {
    Game.setup();
});

