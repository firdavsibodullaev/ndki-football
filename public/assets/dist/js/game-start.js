const GameStart = {
    modal: $("#game-start-modal"),
    form: $("#game-start-form"),
    openModal() {
        this.modal.modal('show');
    },
    submitForm() {
        this.form.submit();
    }
}
