<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class customAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function registration()
    {
        return view("auth.registration");
    }
    public function registerUser(Request $request)
    {
        $request ->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);

        $user            = new User();
        $user ->name     = $request->name;
        $user ->email    = $request->email;
        $user ->password = Hash::make($request->password);
        $res             = $user->save();
        if($res)
        {
            return back()->with('success','You have registered succesfully');
        }
        else
        {
            return back()->with('fail','Something wrong');
        }

    }
    public function loginUser(Request $request)
    {
        $request ->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {
                $request->session()->put('loginId',$user->id);
                return redirect('dashboard');
            }
            else
            {
                return back()->with('fail','password not matches');
            }
        }
        else
        {
            return back()->with('fail','this email not registered');
        }

    }
    public function dashboard()
    {
        $data = array();
        if(session()->has('loginId'))
        {
            $data =User::where('id','=',session()->get('loginId'))->first();
        }
        return view('dashboard',compact('data'));
    }
    public function logout()
    {
        if(session()->has('loginId'))
        {
            session()->pull('loginId');
            return redirect('/');
        }
    }
    public function password_reset()
    {
        return view("password-reset");
    }
    public function change_password(Request $request)
    {
        if(session()->has('loginId'))
        {
            $data =User::where('id','=',session()->get('loginId'))->first();
            $prev_password = $data->password;
        }
        $request->validate([
            'password' => 'required|min:5|max:12',
            'new-password' => 'required|min:5|max:12|different:password|confirmed',
            'new-password_confirmation' => 'required'
        ], [
            'new-password.different' => 'The new password must be different from the current password.',
            'new-password.confirmed' => 'The new password confirmation does not match.',
        ]);
        if(Hash::check($request->password,$prev_password))
        {
            $user = User::find(session()->get('loginId'));
            $user->password = Hash::make($request->input('new-password'));
            $user->save();
            // $request->session()->put('password', $user->password);
            session()->pull('loginId');
            return redirect('/');
        }
        else
        {
            return back()->with('fail','password not matches');
        }

    }
}
