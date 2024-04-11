<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    //

    //show 
    public function showAllUsers()
    {
        $users = User::paginate(3);
        return view('admin.users.list-users', compact('users'));
    }

    //viết hàm in chi tiết users

    public function showDetailUsers($id)
    {
        $users = User::find($id);

        return view('admin.users.detail-users', compact('users'));
    }

    //viết hàm xoá users

    public function deleteUsers($id)
    {

        if (Auth::id() != $id) {
            $users = User::find($id);
            $users->delete();
            return redirect('/index');
        } else {
            return redirect('/index');
        }
    }


    //viết hàm show giao diện update dữ liệu

    public function showEdit($id)
    {
        $users = User::find($id);
        return view('admin.users.update-users', compact('users'));
    }

    public function adminUpdate(Request $request, $id)
    {
        // $request->validate([
        //     'chosefile' => ['required', 'image', 'max:2048'],
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'phone' => ['required', 'string', 'max:10'],
        // ], [
        //     'required' => ':attribute Không được để trống',
        //     'min' => ':attribute có độ dài ít nhất :min kí tự',
        //     'max' => ':attribute có độ dài :max kí tự',
        //     'confirmed' => 'Xác nhận mật khẩu không trùng khớp',
        //     'phone' => 'Nhập đúng số điện thoai',
        // ], [
        //     'chosefile' => 'Ảnh sản phẩm',
        //     'name' => 'Tên người dùng',
        //     'email' => 'Email phải đúng',
        //     'password' => 'Mật khẩu',
        //     'phone' => 'Số điện thoại',
        // ]);


        $file = $request->input('chosefile');

        //
        $file = $request->file('chosefile'); // Lấy file từ request

        if ($file) {
            $file_name = $file->getClientOriginalName();

            // Kiểm tra xem thư mục public/uploads đã tồn tại chưa
            $directory = 'uploads';
            if (!File::exists($directory)) {
                // Nếu thư mục không tồn tại, hãy tạo nó
                File::makeDirectory($directory);
            }

            // Di chuyển tệp tải lên vào thư mục public/uploads
            $path = $file->move($directory, $file_name);

            // Tạo đường dẫn của ảnh từ thư mục uploads
            $thumbnail = $directory . '/' . $file_name;
        } else {
            $thumbnail = null; // Nếu không có tệp tải lên, sử dụng giá trị null cho thumbnail
        }

        User::where('id', $id)->update([
            'avarta' => $thumbnail,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/index');
    }


    
}
