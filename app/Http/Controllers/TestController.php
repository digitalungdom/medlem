<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;

class TestController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        if($user->isMember()) return "JA";
        else return "NEI";
        
    }
}
