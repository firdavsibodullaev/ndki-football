function openDeleteModal(el) {
    const $this = $(el);
    const ids = $this.attr('data-id').split(',');
    let form = $('#delete-form');
    let action = form.attr('base-action');

    ids.forEach((item, index) => {
        action = action.replace(`ID${index}`, item);
    });

    form.attr('action', action);

    $('#delete-modal').modal('show');
}

$(function () {
    $('#delete-modal').on('hide.bs.modal', function () {
        let modal = $(this);
        let form = modal.find('#delete-form');
        form.removeAttr('action');
    });
});
