<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function username(){
        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (is_numeric($login)) {
            $field = 'mobile_number';
        }

        request()->merge([$field => $login]);
        return $field;
    }
    public function login(Request $request){
        if ($request->isMethod('get')) {
            return view('auth.login');
        }else{
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string|min:4',
            ]);
            
            $loginField = $this->username();
            $credentials = $request->only($loginField, 'password');

            if (Auth::attempt($credentials)) {
                if(Auth::user()->role=='user'){
                    return redirect('user'); 
                }else if(Auth::user()->role=='admin'){
                    return redirect('dashboard');
                }
                
            } 
            return redirect()->back()->withErrors(['login' => 'The provided credentials do not match our records.']);
            



        }
        
    }


    public function register(Request $request){
        if ($request->isMethod('get')) {
            return view('auth.register');
        }else{
           $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'username' => 'required|string|max:255|unique:users',
                'mobile_number' => 'required|string|max:15|unique:users',
                'password' => 'required|string|min:4',
                // 'interests' => 'array',
                // 'interests.*' => 'exists:interests,id',
                'role' => 'required|in:user,admin',
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => $request->mobile_number,
                'password' => Hash::make($request->password),
                'profile_image'=>'',
                'role' => $request->role,
            ];

            if ($request->hasFile('profile_image')) {
                $imageName = time().'.'.$request->profile_image->extension();
                $request->profile_image->move(public_path('images'), $imageName);
                $data['profile_image'] = 'images/'.$imageName;
                
            }
            $user = User::create($data);
            return redirect('login');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
