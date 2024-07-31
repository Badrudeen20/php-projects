<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function index(Request $request){
        $user = User::where(['role'=>'user','id'=>auth()->user()->id])->first();
        return view('user',compact('user'));
    }

    public function update(Request $request,$id){
        $user = User::where(['role'=>'user','id'=>$id])->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'mobile_number' => 'required|string|max:15|unique:users,mobile_number,'.$id,
            
        ]);
        $data = [
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'username' => $request->username ?? $user->username,
            'mobile_number' => $request->mobile_number ?? $user->mobile_number,
            'profile_image'=>$user->profile_image,
            // 'password'=>$user->password
        ];

        
        if ($request->hasFile('profile_image')) {
            $this->destroy($user->profile_image);
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $data['profile_image'] = 'images/'.$imageName;
        }
        $user = User::where('id',$id)->update($data);
        return redirect()->back();
    }

    public function destroy($filename){
        $filePath = public_path($filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
