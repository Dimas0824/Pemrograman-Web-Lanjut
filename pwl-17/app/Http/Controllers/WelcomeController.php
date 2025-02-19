<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function hello(){
        return "Helllo World";
    }

    public function greeting(){
        return view('blog.hello', [
            'name' => 'Irsyad Dimas'
        ]);
    }
}
