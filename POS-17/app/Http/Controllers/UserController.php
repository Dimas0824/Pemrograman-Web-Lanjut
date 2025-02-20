<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile', [
            'id' => 17,
            'name' => 'Muhammad Irsyad Dimas Abdillah'
        ]);
    }
}
