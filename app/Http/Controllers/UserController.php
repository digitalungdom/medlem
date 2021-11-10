<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index() {
        $this->authorize('users', User::class);
        return view('admin/users');
    }

    
}
