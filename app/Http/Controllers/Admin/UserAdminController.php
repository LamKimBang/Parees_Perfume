<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use App\Models\User_status;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $data = [
            'genders' => Gender::get(),
            "roles" => Role::get(),
            "users_status" => User_status::get(),
            'users' => DB::table('user')
                ->join('gender', 'user.gender_id', '=', 'gender.id')
                ->join('user_status', 'user.user_status_id', '=', 'user_status.id')
                ->join('role', 'user.role_id', '=', 'role.id')
                ->select(
                    'user.*',
                    'gender.gender_name',
                    'gender.id as ge_id',
                    'role.role_name',
                    'role.id as ro_id',
                    'user_status.status_name',
                    'user_status.id as st_id'
                )
                ->get(),
            'title' => 'User',
        ];
        return view('admin/user/index')->with($data);
    }
    public function insert(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|max:250|unique:user',
                'full_name' => 'required|string|max:250',
                'phone' => 'required|min:10',
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
            'username' =>  $request->input('username'),
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
            return redirect('admin/user')->with($data);
        } elseif ($request->password != $request->confirmPassword) {
            return redirect('admin/user');
        }
        return view('admin/user');
    }
    public function updateuser(Request $request)
    {
        $data = [
            'users' => DB::table('user')
                ->join('gender', 'user.gender_id', '=', 'gender.id')
                ->join('user_status', 'user.user_status_id', '=', 'user_status.id')
                ->join('role', 'user.role_id', '=', 'role.id')
                ->select(
                    'user.*',
                    'gender.gender_name',
                    'gender.id as ge_id',
                    'role.role_name',
                    'role.id as ro_id',
                    'user_status.status_name',
                    'user_status.id as st_id'
                )
                ->get(),
            'user' => User::find($request->get('id')),
            'genders' => Gender::get(),
            "roles" => Role::get(),
            "users_status" => User_status::get(),
            'title' => 'User'
        ];
        return view('admin/user/update')->with($data);
    }

    public function processupdateuser(Request $request)
    {

        $data = [
            'username' =>  $request->input('username'),
            'date_of_birth' => DateTime::createFromFormat('m/d/Y', $request->input('date_of_birth'))->format('Y-m-d'),
            'full_name' =>  $request->input('full_name'),
            'gender_id' => $request->input('gender'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'home_address' => $request->input('home_address'),
            'company_address' => $request->input('company_address'),
            'user_status_id' => $request->input('user_status_id'),
            'role_id' => $request->input('role_id'),
        ];

        User::where('id', $request->post('id'))->update($data);
        return redirect('admin/user')->with($data);
    }
}
