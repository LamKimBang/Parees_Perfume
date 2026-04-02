<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountInfoController extends Controller
{
    public function index(Request $request)
    {
        $user = new User();
        if ($request->session()->has('member')) {
            $member = $request->session()->get('member');
            foreach ($member as $item) {
                $userId = $item['id'];
            }
            $user = User::find($userId);
        }
        $data = [
            'title' => 'Account Information',
            'user' => $user,
            'genders' => Gender::get(),
        ];
        return view('user/account-info/index')->with($data);
    }


    public function update(Request $request)
    {
        $userId = 0;
        if ($request->session()->has('member')) {
            $member = $request->session()->get('member');
            foreach ($member as $item) {
                $userId = $item['id'];
            }
        }

        $user = [
            'password' => Hash::make($request->input('pwd-password-new')),
            'date_of_birth' => DateTime::createFromFormat('m/d/Y', $request->input('date_of_birth'))->format('Y-m-d'),
            'full_name' =>  $request->input('full_name'),
            'gender_id' => $request->input('gender'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'home_address' => $request->input('home_address'),
            'company_address' => $request->input('company_address'),
        ];
        
        User::where('id', $userId)->update($user);
        return redirect()->back();
    }

    // public function check_profile(Request $request)
    // {
    //     $auth = auth('user')->user();
    //     $rule = [
    //         'full_name' => 'min:6',
    //         'phone_number' => 'integer',
    //         'email' => 'required|email|min:6|unique:user, email,' . $auth->id,
    //         'password' => ['required', function ($attr, $value, $fail) use ($auth) {
    //             if (!Hash::check($value, $auth->password)) {
    //                 return $fail('Your password is not match');
    //             }
    //         }],
    //         [
    //             'full_name.required' => 'Full name cannot be empty',
    //             'full_name.min' => 'Full name must be at least 6 characters'
    //         ]
    //     ];

    //     $data = $request->only('full_name', 'email', 'phone_number', 'home_address', 'com_address', 'gender');

    //     $check = $auth->update($data);

    //     if ($check) {
    //         return redirect()->back()->with('no', 'Something  error, please check again');
    //     } else

    //         return redirect()->back()->with('ok', 'Update successfully');
    // }

    // public function change_password()
    // {
    //     return view('user/account-info/index');
    // }

    // public function check_change_password(Request $request)
    // {
    //     $auth = auth('user')->user();
    //     $request->validate([
    //         'current_password' => ['required', function ($attr, $value, $fail) use ($auth) {
    //             if (!Hash::check($value, $auth->password)) {
    //                 $fail('Your password is now match');
    //             }
    //         }],
    //         'password' => 'min:6',
    //         'confirm_password' => 'required|same:password'
    //     ]);

    //     $data['password'] = bcrypt($request->password);
    //     $check = $auth->update($data);
    //     if ($check) {
    //         $auth('user')->logout();
    //         return redirect()->route('login/index')->with('ok', 'Your password update successfully');
    //     }
    //     return redirect()->back()->with('no', 'Something error, please check again');
    // }
}
