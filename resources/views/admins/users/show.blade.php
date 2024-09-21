<form action="{{ route('users.update', ['id' => $data->id]) }}" method="POST" id="submit_form_edit"
    enctype="multipart/form-data">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label class="mb-1">Tên người dùng</label>
            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            <div id="name-error" class="text-danger fs-6"></div>
        </div>
        <div class="form-group">
            <label class="mb-1">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ $data->email }}">
            <div id="email-error" class="text-danger fs-6"></div>
        </div>
        <div class="form-group">
            <label class="mb-1">Avatar:</label>
            <input type="file" class="form-control" name="avatar">
            <div id="avatar-error" class="text-danger fs-6"></div>
            <div class="border mt-2">
                <img width="80" src="{{ asset($data->avatar) }}" alt="">
            </div>
        </div>
        <div class="form-group">
            <label class="mb-1">Date:</label>
            <input type="date" class="form-control" name="establish" value="{{ $data->establish }}">
            <div id="establish-error" class="text-danger fs-6"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" id="btn-submit-add">Thêm mới</button>
    </div>
</form>
