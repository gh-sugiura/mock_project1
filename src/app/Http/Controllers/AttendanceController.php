<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
require "../vendor/autoload.php";


class AttendanceController extends Controller
{
    public function get_register()
    {
        return view("register");
    }


    public function get_login()
    {
        return view("login");
    }


    public function get_index()
    {
        $stamp_attendance = Attendance::where("user_id",Auth::id())
                            ->whereDate("created_at", Carbon::now())
                            ->first();
        $stamp_rest = Rest::where("user_id",Auth::id())
                            ->whereDate("created_at", Carbon::now())
                            ->orderBy("created_at","desc")
                            ->first();
        return view("index", compact("stamp_attendance","stamp_rest"));
    }


    public function start_work()
    {
        $start_work = [
            "user_id" => Auth::id(),
            "start_work" => Carbon::now()->toTimeString(),
        ];
        $attendance_start_work = Attendance::where("user_id", Auth::id())
                                ->whereDate("created_at", Carbon::now())
                                ->first();                           
        if(is_null($attendance_start_work)) {
            Attendance::create($start_work);
            return redirect("/")
            ->with("message", "勤務中");
        }else{
            return redirect("/")
            ->with("message", "勤務は1日1回までです。本日の業務は終了しております。");
        }
    }


    public function finish_work()
    {
        $finish_work = [
            "finish_work" => Carbon::now()->toTimeString(),
        ];
        Attendance::where("user_id", Auth::id())
                    ->whereDate("created_at", Carbon::now())
                    ->update($finish_work);
        return redirect("/")
        ->with("message", "本日の勤務を終了しました。お疲れ様でした。");
    }


    public function start_rest()
    {
        $start_rest = [
            "user_id" => Auth::id(),
            "start_rest" => Carbon::now()->toTimeString(),
        ];
        Rest::create($start_rest);
        return redirect("/")
        ->with("message", "休憩中");
    }


    public function finish_rest()
    {
        $finish_rest = [
            "finish_rest" => Carbon::now()->toTimeString(),
        ];
        Rest::where("user_id", Auth::id())
            // ->whereDate("created_at", Carbon::now())
            ->orderBy("created_at", "desc")
            ->first()
            ->update($finish_rest);
        return redirect("/")
        ->with("message", "勤務中");
    }


    public function get_attendance()
    {
        $attendances = Attendance::Paginate(5);
        return view("attendance", compact("attendances"));
    }
}


?>