<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;


class AttendanceController extends Controller
{
    public function get_index()
    {
        return view("index");
    }


    public function get_register()
    {
        return view("register");
    }


    public function get_login()
    {
        return view("login");
    }


    public function get_attendance()
    {
        return view("attendance");
    }


    // public function post_register(Request $request)
    // {
    //     // $items = $request->all();
    //     // dd($items);
    // }
    // 
    // public function post_register(RegisterRequest $request)
    // {
    //     $register = $request->only(['name', 'email', 'password', 'password_confirmation']);
    //     User::create($register);
    //     return view("login");
    // }
    // 
    // public function post_logout()
    // {
    //     return view("login");
    // }


    
}


?>