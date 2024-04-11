@extends('layouts.adminusers')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
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
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">SDT</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
         @php
             $count = 0;
         @endphp

                    @foreach ($users as $item)
                    @php
                        $count ++;
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <th scope="row">{{ $count }}</th>
                        <td><img src="{{ url($item->avarta) }}" alt="" height="80px" width="100px"></td>
                        <td><a href="{{ route('detail.users',['id' => $item->id]) }}">{{ $item->name }}</a></td>
                        <td><a href="{{ route('detail.users',['id' => $item->id]) }}">{{ $item->email }}</a></td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <a href="{{ route('update',['id'=>$item->id]) }}" class="btn btn-success btn-sm rounded-0 text-white" onclick="return confirm('Bạn thực sự muốn sửa không nả')"  type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            @if(Auth::id() != $item->id)
                            <a href="{{ route('delete',['id'=>$item->id]) }}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn thực sự muốn xoá không nả')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                   
                   
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection