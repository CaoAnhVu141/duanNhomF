@extends('layouts.adminusers')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{ route('update.users',$users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="chosefile">Chọn ảnh sản phẩm:</label>
                    <input type="file" class="form-control-file" name="chosefile" id="chosefile">
                </div>
            
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $users->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ $users->email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control" type="text" name="phone" id="phone" value="{{ $users->phone }}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
            
                <button type="submit" name="btnupdate" class="btn btn-primary">Cập nhật</button>
            </form>            
        </div>
    </div>
</div>
@endsection