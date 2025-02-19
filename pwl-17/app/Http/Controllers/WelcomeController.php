<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function hello(){
        return "Helllo World";
    }

    public function greeting(){
        return view('blog.hello')
            ->with('name', 'Irsyad Dimas')
            ->with('occupation', 'Astronaut');
    }
}
