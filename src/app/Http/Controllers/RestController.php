<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use DateTime;


class RestController extends Controller
{
    public function post_start_rest()
    {
        $attendance_id = Attendance::where("user_id", Auth::id())
            ->whereDate("created_at", Carbon::now())
            ->first()
            ->id;

        $start_rest = [
            "attendance_id" => $attendance_id,
            "start_rest" => Carbon::now()->toTimeString(),
        ];
        Rest::create($start_rest);
        return redirect("/")
            ->with("message", "休憩中");
    }


    public function post_finish_rest()
    {
        $attendance_id = Attendance::where("user_id", Auth::id())
            ->whereDate("created_at", Carbon::now())
            ->first()
            ->id;
        $finish_rest = [
            "finish_rest" => Carbon::now()->toTimeString(),
        ];
        Rest::where("attendance_id", $attendance_id)
            ->whereDate("created_at", Carbon::now())
            ->orderBy("created_at", "desc")
            ->first()
            ->update($finish_rest);
        return redirect("/")
            ->with("message", "勤務中");
    }
}


?>