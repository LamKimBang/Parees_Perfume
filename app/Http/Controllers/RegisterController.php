<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gender;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'genders' => Gender::get(),
            'title' => 'Register'
        ];
        return view('register/index')->with(($data));
    }

    public function insertUser(Request $request)
    {

        $request->validate(
            [
                // 'username' => 'required|string|max:250|unique:user',
                'full_name' => 'required|string|max:250',
                'phone' => 'required|min:10|unique:user',
                'email' => 'required|email|unique:user',
                'date_of_birth' => 'required|date_format:m/d/Y|before:today',
                'home_address' => 'required',
                'password' => 'required|min:8',
                'confirmPassword' => 'required|same:password',
                'home_address' => 'required',
                'company_address' => 'required',
            ],
        );
        $data = [
            'username' =>  $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'date_of_birth' => DateTime::createFromFormat('m/d/Y', $request->input('date_of_birth'))->format('Y-m-d'),
            'full_name' =>  $request->input('full_name'),
            'gender_id' => $request->input('gender'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'home_address' => $request->input('home_address'),
            'company_address' => $request->input('company_address'),
            'user_status_id' => 1,
            'role_id' => 2,
            'deleted' => 0,
        ];
        if ($request->password == $request->confirmPassword && $request->password != '') { 
            User::create($data);
            if ($request->selector == true) {
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
            return redirect('login')->with($data);
        } elseif ($request->password != $request->confirmPassword) {
            return view('/index');
        }
    }
}
