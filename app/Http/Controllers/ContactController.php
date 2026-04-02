<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Contact'
        ];
        return view('contact/index')->with($data);
    }
}
