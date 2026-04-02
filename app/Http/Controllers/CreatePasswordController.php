<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreatePasswordController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Create Password'
        ];
        return view('create-password/index')->with($data);
    }

    public function postCreate(Request $request)
    {
        // validate
        $request->validate(
            [
                'phone' => 'required|min:10',
                'password' => 'required|min:8',
                'confirmPassword' => 'required|same:password',
            ],
        );

        $data = [
            'username' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 2,
        ];
        if (User::where('phone', $request->input('phone'))->first() == null) {
            $error = [
                'error' => 'The phone number does not exist !'
            ];
            return redirect()->back()->with($error);
        } else {
            User::where('id', User::where('phone', $request->input('phone'))->first()->id)->update($data);
            return redirect('login/index');
        }
    }
}
