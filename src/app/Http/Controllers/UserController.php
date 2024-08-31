<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
require "../vendor/autoload.php";


class UserController extends Controller
{
    public function get_register()
    {
        return view("register");
    }


    public function get_login()
    {
        return view("login");
    }


    public function get_register_user(Request $request)
    {   
        if ($request["button"]=="search") {
            $users = User::where("name", "LIKE", "%{$request["search_name"]}%")
                ->orderBy('created_at')
                ->Paginate(5);
            return view("register_user", compact("users"));
        }else{
            $users = User::orderBy('created_at')
                ->Paginate(5);
            return view("register_user", compact("users"));
        }
    }
}


?>