@extends('admins.layouts.app')

@section('title')
    <title>Sửa danh mục</title>
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">Danh mục</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa danh mục</li>
        </ol>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <form action="{{ route('category.update', ['id' => $edit->id]) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên danh mục</label>
                                    <input type="text" class="form-control" name="name" value="{{ $edit->name }}">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Mô tả</label>
                                    <textarea name="description" class="form-control">{{ $edit->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="error text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Xác nhận sửa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
