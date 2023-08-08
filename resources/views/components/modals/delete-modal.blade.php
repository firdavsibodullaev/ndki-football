<div class="modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-danger">
                <h4 class="modal-title">Удаление</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы действительно хотите удалить?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"
                        onclick="document.querySelector('#delete-form').submit()"
                        class="btn btn-danger">Удалить
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <form base-action="{{ $action }}" id="delete-form" method="post">
        @csrf
        @method('delete')
    </form>
</div>
@pushonce('js')
    <script src="{{ asset('assets/dist/js/delete-modal.js') }}"></script>
@endpushonce
