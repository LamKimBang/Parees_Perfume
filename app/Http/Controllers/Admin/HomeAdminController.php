<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeAdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
        ];
        return view('admin/home/index')->with($data);
    }
}
