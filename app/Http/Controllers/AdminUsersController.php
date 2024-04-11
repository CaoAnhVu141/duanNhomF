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
        $users = User::orderBy('created_at','desc')->paginate(3);

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
