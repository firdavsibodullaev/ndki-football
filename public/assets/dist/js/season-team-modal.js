const SeasonTeam = {
    activeTeams: [],
    teamModal: $("#season-team-modal"),
    setup() {
        this.getActiveTeams();
    },
    getActiveTeams() {
        let teams = [];
        if (this.activeTeams.length > 0) {
            return
        }
        $.ajax({
            url: `${location.origin}/admin/team/list-json`,
            method: 'get',
            async: false,
            success(response) {
                teams = response.data;
            }
        });
        this.activeTeams = teams;
        teams = [];
    },
    openModal() {
        this.getActiveTeams();
        this.fillModalBody();
        this.teamModal.modal('show');
    },
    fillModalBody() {
        const tbody = this.teamModal.find('table>tbody');
        tbody.html('');
        for (let i = 0; i < this.activeTeams.length; i++) {
            let team = this.activeTeams[i];
            let tr = $('<tr>');
            let checkbox = this.getCheckbox(team);
            let teamId = this.getTeamId(team);
            let logo = this.getLogo(team);
            let name = this.getTeamName(team);
            tbody.append(
                tr.append(checkbox).append(teamId).append(logo).append(name)
            );
        }
    },
    getCheckbox(team) {
        const td = $('<td>');
        const block = $('<block>', {
            class: 'icheck-primary'
        });
        const checkbox = $('<input>', {
            onclick: 'SeasonTeam.isAllChecked()',
            type: 'checkbox',
            class: 'team-checkbox',
            id: `team-chechbox-${team.id}`,
            name: 'teams[]',
            checked: true,
            value: team.id
        });
        const label = $('<label>', {
            for: `team-chechbox-${team.id}`
        });

        return td.append(
            block.append(checkbox).append(label)
        );
    },
    getTeamId(team) {
        return $('<td>', {
            text: team.id
        });
    },
    getLogo(team) {
        const td = $('<td>');
        const anchor = $('<a>', {
            "data-src": team.logo?.url,
            "data-fancybox": "team-logo",
            "href": "javascript.void(0)"
        });
        const img = $('<img>', {
            style: 'width:1.5rem; object-fit: contain; aspect-ratio: 1',
            src: team.logo?.url,
            alt: team.logo?.filename
        });
        return td.append(
            anchor.append(img)
        );
    },
    getTeamName(team) {
        return $('<td>', {
            text: team.name
        });
    },
    allSelected(el) {
        $('input.team-checkbox').prop('checked', $(el).prop('checked'));
    },
    isAllChecked() {
        const hasNotCheckedCheckbox = $('input.team-checkbox:not(:checked)').length > 0;
        $('#season-team-modal-all-selected').prop('checked', !hasNotCheckedCheckbox);
    },
    submitForm(el) {
        const $this = $(el);
        const checkbox = $this.find('input.team-checkbox:checked');

        if(checkbox.length % 2 !== 0) {
            return toastr.error('Количество команд должно быть чётным');
        }

        $this.submit();
    }
}

$(function () {
    SeasonTeam.setup();
});
