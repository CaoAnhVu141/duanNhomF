<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AminLoginRegister extends Controller
{
    //

     ///hàm show register

     public function showRegister()
     {
         return view('admin.loginandregister.register');
     }
 
     public function showLogin()
     {
         return view('admin.loginandregister.login');
 
     }


     ///viết hàm thực hiện đăng kí

     public function adminRegister(Request $request) {
        
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

    //thực hiện đăng kí tài khoản

    // User::create([
    //     'name' => $request->input('name'),
    //     'email' => $request->input('email'),
    //     'phone' => $request->input('phone'),
    //     'password' => $request->input('password'),
    //     'avarta' => $thumbnail
    // ]);
    User::create([
        'avarta' => $thumbnail,
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'password' => Hash::make($request->input('pass')),
        
    ]);
    

    return redirect('/login')->with('status',"Thành công rồi bạn ơi");
      
     }


     //viết hàm login 

     public function adminLogin(Request $request) {

      $credentials = $request->only('email','password');
      if(Auth::attempt($credentials))
      {
        return redirect('/index');
      }
      else{
        return redirect('/login');
      }
        
     }

    


     //
     public function logOut() {
        Auth::logout();
        return redirect('login');
     }
}
