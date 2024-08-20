<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileSuperAdminController extends Controller
{
    public function index(){
        return view('super-admin.profile.index');
    }

    public function updateProfileSuperAdmin(Request $request){
        //--------- VALIDASI DATA --------------//
       $request->validate([
        'name' => [ 'max:100'],
        'email' => [ 'email','unique:users,email,'.Auth::user()->id],
        'image' => ['image','max:2048'],
        'phone' => ['max:100'],
        'username' => ['max:100'],
       ]);
       //-------------------------------------// 

       //------ Kondisi menampilkan gambar default saat gambar kosong ----------//
       $user = Auth::user();
       
       if($request->hasFile('image')){
        if(File::exists(public_path($user->image))){
            File::delete(public_path($user->image));
        }
        //----------------------------------------------//

         //------------ FUNCTION UNTUK MENYIMPAN GAMBAR YANG DIUPLOAD -----------------//
        $image = $request->image;
        $imageName = rand().'_'.$image->getClientOriginalName();
        $image->move(public_path('uploads'),$imageName);

        $path = "/uploads/".$imageName;
        $user->image = $path;
       }
       //===================== NEDS OF FUNCTION =============================//
       
       //--------- UPDATE USERNAME & EMAIL -------------//
       $user->name = $request->name;
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->username = $request->username;
       $user->save();
       toastr()->success('Profile updated succesfully');
       return redirect()->route('super-admin.dashboard');
    }

    public function updatePasswordSuperAdmin(Request $request){
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required','confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);
        toastr()->success('Password updated succesfully');
        return redirect()->route('super-admin.dashboard');
    }
}