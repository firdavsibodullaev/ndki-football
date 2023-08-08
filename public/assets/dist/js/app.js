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
    $('.select2').select2({
        theme: 'bootstrap4'
    });
});
