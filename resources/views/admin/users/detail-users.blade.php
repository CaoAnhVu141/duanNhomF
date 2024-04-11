@extends('layouts.adminusers')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Thông tin chi tiết tài khoản</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
          
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        
                        <th scope="col">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Ngày đăng kí</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td><img src="{{ url($users->avarta) }}" alt="" height="80px" width="100px"></td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                          <td>{{ $users->phone }}</td>
                          <td>{{ $users->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection