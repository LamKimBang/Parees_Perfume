<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login Admin'
        ];
        return view('login/index-admin')->with($data);
    }

    public function postLoginAdmin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $member = [
                'admin' =>
                [
                    'username' => $request->input('username'),
                    'full_name' => User::where('username', $request->username)->first()->full_name,
                    'id' => User::where('username', $request->username)->first()->id,
                    'role_id' => User::where('username', $request->username)->first()->role_id
                ]
            ];
            if (User::where('username', $request->username)->first()->role_id == 3) {
                $request->session()->put('admin', $member);
            } else {
                $data = [
                    'error' => 'You can not access this page !'
                ];
                return redirect()->back()->with($data);
            }
            return redirect('admin/index');
        }
        $data = [
            'error' => 'Username or password wrong !'
        ];
        return redirect()->back()->with($data);
    }

    public function getLogoutAdmin(Request $request)
    {
        $request->session()->forget('admin'); // huy session
        Auth::logout();
        return redirect('login/index-admin');
    }
}
