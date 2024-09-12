<form action="{{ route('management.roles.update', ["id" => $role->id]) }}" method="POST" id="submit_form_edit">
    <div class="modal-body">
        @method("PUT")
        @csrf
        <div class="form-group">
            <label class="mb-1">{{ __('messages.position') }}:</label>
            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
            <input type="text" class="form-control" name="id" hidden value="{{ $role->id }}">
            <div id="name-edit-error" class="text-danger fs-6"></div>
        </div>

        @foreach ($arr_permissions as $key => $permission_group)
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label class="my-input">
                        {{ $key }}
                    </label>
                    <div class="form-check">
                        <input class="form-check-input select-all input-checkbox-m" type="checkbox" value=""
                            id="select-all-{{ $key }}">
                        <label class="form-check-label pl-0" for="select-all-{{ $key }}">
                            Chọn tất cả
                        </label>
                    </div>
                </div>
                <div class="form-group" style="border: 1px solid rgba(0, 0, 0, .15);">
                    <div class="d-flex flex-wrap pt-3 pb-3">
                        @foreach ($permission_group as $permission)
                            <div class="col-md-4 pl-3">
                                <div class="form-check">
                                    <input class="form-check-input input-checkbox-m" name="permission[]" type="checkbox"
                                        data-group="{{ $key }}" value="{{ $permission['id'] }}"
                                        id="permission{{ $permission['id'] }}" @if (in_array($permission['id'], $permissions))
                                            {{ 'checked' }}
                                        @endif>
                                    <label class="form-check-label pl-0" for="permission{{ $permission['id'] }}">
                                        {{ $permission['title'] }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-edit">{{ __('messages.update') }}</button>
    </div>
</form>
