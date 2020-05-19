<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm(){
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
           $request->validate([
               'current-password' =>
                   ['required',
                   function($attribute, $value, $fail) {
                             if (!(Hash::check($value, Auth::user()->password)))
                               {
                           return $fail($attribute.' is incorrect.');

                       }
                   },
               ],
               'new-password' => 'required|min:6|confirmed',
           ]);


        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request['new-password']);
        $user->save();
        return redirect()->back()->with("success","تم تغير كلمة الرمور بنجاح");
    }
}
