<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;


class AttendanceController extends Controller
{
    public function index()
    {
        return view("index");
    }


    public function register()
    {
        return view("register");
    }


    public function login()
    {
        return view("login");
    }


    public function store(RegisterRequest $request)
    {
        $register = $request->only(['name', 'email', 'password', 'password_confirmation']);
        User::create($register);
        return view("login");
    }


    public function attendance()
    {
        return view("attendance");
    }
}


?>