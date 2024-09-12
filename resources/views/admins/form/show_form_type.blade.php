<form action="{{ route('admin.form.update_form_type', ["id" => $data->id]) }}" method="POST" id="submit_form_edit">
    <div class="modal-body">
        @method("PUT")
        @csrf
        <div class="form-group">
            <label class="mb-1">{{ __('messages.position') }}:</label>
            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            <input type="text" class="form-control" name="id" hidden value="{{ $data->id }}">
            <div id="name-edit-error" class="text-danger fs-6"></div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-edit">{{ __('messages.update') }}</button>
    </div>
</form>
