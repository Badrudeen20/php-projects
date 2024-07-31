<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Exports\ExportUser;
class AdminController extends Controller
{

    public function index(Request $request){
        $users = User::where('role', 'user')->get();
        return view('dashboard', compact('users'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);
        $errorMsg = "";
        $rawData = Excel::toArray('', $request->file('csv')->getRealPath(), null, \Maatwebsite\Excel\Excel::TSV)[0];
        // dd($rawData);
        if (count($rawData) > 0 ) {
            foreach ($rawData as $key => $row) {
                if ($key > 0) {
                    $insertArr = [
                        'name'=>$row[0],
                        'email'=>$row[1],
                        'username' => $row[2],
                        'password' => $row[3],
                        'mobile_number'=>$row[4],
                    ];  
                    $check =  User::where('email',$row[1])
                    ->orWhere('username', $row[2])
                    ->orWhere('mobile_number', $row[4])
                    ->first();
                    
                    if($check){
                        $errorMsg .= $row[$key] . "  is already taken! <br>";
                    }
                    
                    // User::insert($insertArr);
                }
            }
            if (!empty($errorMsg)) {
                return redirect()->back()->withErrors(['csv' => $errorMsg]);
            }

            foreach ($rawData as $key => $row) {
                if ($key > 0) {
                    $insertArr = [
                        'name'=>$row[0],
                        'email'=>$row[1],
                        'username' => $row[2],
                        'password' => $row[3],
                        'mobile_number'=>$row[4],
                    ];     
                    User::insert($insertArr);
                }
            }
         
        }


        return redirect()->back()->with('success', 'Users uploaded successfully.');
    }

    public function download(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}
