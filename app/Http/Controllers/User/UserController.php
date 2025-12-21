<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view("landing.index");
    }

    public function project() {
        return view("landing.project");
    }

    public function about() {
        return view("landing.about");
    }

    public function contact() {
        return view("landing.contact");
    }
}
