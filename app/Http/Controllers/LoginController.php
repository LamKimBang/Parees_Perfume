<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login/index')->with($data);
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $member = [
                'member' =>
                [
                    'username' => $request->input('username'),
                    'full_name' => User::where('username', $request->username)->first()->full_name,
                    'id' => User::where('username', $request->username)->first()->id,
                    'role_id' => User::where('username', $request->username)->first()->role_id
                ]
            ];
            $request->session()->put('member', $member);
            return redirect('index');
        }
        $data = [
            'error' => 'Username or password wrong !'
        ];
        return redirect()->back()->with($data);
    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('member'); // huy session
        Auth::logout();
        return redirect()->back();
    }
}
