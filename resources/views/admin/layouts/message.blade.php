@if(session()->has('password_message'))
    <div class="alert alert-default-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session()->get('password_message') }}
    </div>
@endif
