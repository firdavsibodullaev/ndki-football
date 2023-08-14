$(function () {
    initSelect2();
});

initSelect2 = function () {
    const select2 = $('.select2');
    if (select2.length > 0) {
        select2.select2({
            theme: 'bootstrap4'
        });
    }
};

