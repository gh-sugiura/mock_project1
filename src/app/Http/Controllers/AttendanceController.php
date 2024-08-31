<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use DateTime;
require "../vendor/autoload.php";


class AttendanceController extends Controller
{
    public function get_index()
    {
        $stamp_attendance = Attendance::where("user_id",Auth::id())
            ->whereDate("created_at", Carbon::now())
            ->first();                
        if(isset($stamp_attendance)) {
            $attendance_id = $stamp_attendance->id;
        }else{
            $attendance_id = 0;
        }

        $stamp_rest = Rest::where("attendance_id", $attendance_id)
            ->whereDate("created_at", Carbon::now())
            ->orderBy("created_at","desc")
            ->first();
        return view("index", compact("stamp_attendance","stamp_rest"));
    }


    public function post_start_work()
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


    public function post_finish_work()
    {
        $stamp_start_work = Attendance::where("user_id", Auth::id())
            ->whereDate("created_at", Carbon::now())
            ->first();
        $finish_work = [
            "finish_work" => Carbon::now()->toTimeString(),
        ];
        $finish_work_cutoff = [
            "finish_work" => "23:59:59",
        ];


        if(isset($stamp_start_work)) {
            Attendance::where("user_id", Auth::id())
                ->whereDate("created_at", Carbon::now())    //この1行いらないかも
                ->update($finish_work);
            return redirect("/")
                ->with("message", "本日の勤務を終了しました。お疲れ様でした。");
        }else{
            Attendance::where("user_id", Auth::id())
                ->update($finish_work_cutoff);
            return redirect("/")
                ->with("message", "本日の勤務を日付変更前に終了しました。お疲れ様でした。");
        }
    }


    public function get_attendance_date(Request $request)
    {
        // define a day for search
        if($request["button"] == "back"){
            $search_day = new Carbon($request["search_day"]);
            $search_day -> subDay();
            $search_day = $search_day->format("Y-m-d");      
        }elseif($request["button"] == "forward"){
            $search_day = new Carbon($request["search_day"]);
            $search_day -> addDay();
            $search_day = $search_day->format("Y-m-d");
        }else{
            $search_day = Carbon::now()->format("Y-m-d");
        }

        // get model infomation
        $attendance_user = Attendance::with(["user"])
            ->whereDate("created_at", $search_day)
            ->get();
        $attendance_rests = Attendance::with(["rests"])
            ->whereDate("created_at", $search_day)
            ->get();


         // define variable
        $name = [];
        $start_work = [];
        $finish_work = [];
        $time_work_diff = [];
        $time_rest = [];
        $rest_each = [];
        $parson = [];
        $attendances = [];


        // get $name, $start_work, $finish_work
        foreach ($attendance_user as $i) {
            // if (isset($i->user["name"])) {
                $name[] = $i->user["name"];
                $start_work[] = $i["start_work"];
                $finish_work[] = $i["finish_work"];

                $work_diff = strtotime($i["finish_work"]) - strtotime($i["start_work"]);
                $work_hour_diff = floor($work_diff / 3600);
                $work_minute_diff = floor(($work_diff % 3600) / 60);
                $work_second_diff = floor($work_diff % 60);
                $time_work_diff[] = $work_hour_diff . ":" . $work_minute_diff . ":" . $work_second_diff;
            // }else{
            //     $name = [];
            //     $start_work = [];
            //     $finish_work = [];
            //     $time_work_diff = [];
            // }
        }


        // calculate $time_rest
        for ($i = 0; $i < count($attendance_rests); $i++) {
            foreach ($attendance_rests[$i]->rests as $j) {
                // if (isset($j["start_rest"])) {
                    $rest_diff = strtotime($j["finish_rest"]) - strtotime($j["start_rest"]);
                // }else{
                    // $rest_diff = 0;
                // }
                $rest_each[] = $rest_diff;
            }
            $rest_sum = array_sum($rest_each);
            $rest_hour = floor($rest_sum / 3600);
            $rest_minute = floor(($rest_sum % 3600) / 60);
            $rest_second = floor($rest_sum % 60);
            $time_rest[] = $rest_hour . ":" . $rest_minute . ":" . $rest_second;
            $rest_each = [];
        }

        // calculate $time_work
        for ($i = 0; $i < count($time_work_diff); $i++) {
            $work_rest = strtotime($time_work_diff[$i]) - strtotime($time_rest[$i]);
            $work_hour = floor($work_rest / 3600);
            $work_minute = floor(($work_rest % 3600) / 60);
            $work_second = floor($work_rest % 60);
            $time_work[] = $work_hour . ":" . $work_minute . ":" . $work_second;
        }


        // create $attendances
        for ($i = 0; $i < count($name); $i++) {
            $person = [
                "name" => $name[$i],
                "start_work" => $start_work[$i],
                "finish_work" => $finish_work[$i],
                "time_rest" => $time_rest[$i],
                "time_work" => $time_work[$i],
            ];
            $attendances[] = $person;
        }


        // pagenation of $attendances 
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page, 5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url()),
        );
        return view("attendance", compact("attendances", "search_day"));
    }


    public function get_attendance_user(Request $request)
    {
        // get model infomation
        if ($request["button"] == "search") {
            $user_id = User::where("name", "LIKE", "%{$request["search_name"]}%")
                ->get(["id"]);
            $user_id = $user_id[0]["id"];
               $attendance_user = Attendance::with(["user"])
                ->where("user_id", "$user_id")
                ->get();
            $attendance_rests = Attendance::with(["rests"])
                ->where("user_id", "$user_id")
                ->get();
        } else {
            $attendance_user = Attendance::with(["user"])
                ->get();
            $attendance_rests = Attendance::with(["rests"])
                ->get();
        }


        // define variable
        $name = [];
        $start_work = [];
        $finish_work = [];
        $work_date = [];
        $time_work_diff = [];
        $time_rest = [];
        $rest_each = [];
        $parson = [];
        $attendances = [];


        // get $name, $start_work, $finish_work
        foreach ($attendance_user as $i) {
            // if (isset($i->user["name"])) {
            $name[] = $i->user["name"];
            $start_work[] = $i["start_work"];
            $finish_work[] = $i["finish_work"];
            $work_date[] = $i["created_at"]->format("Y-m-d");

            $work_diff = strtotime($i["finish_work"]) - strtotime($i["start_work"]);
            $work_hour_diff = floor($work_diff / 3600);
            $work_minute_diff = floor(($work_diff % 3600) / 60);
            $work_second_diff = floor($work_diff % 60);
            $time_work_diff[] = $work_hour_diff . ":" . $work_minute_diff . ":" . $work_second_diff;
            // }else{
            //     $name = [];
            //     $start_work = [];
            //     $finish_work = [];
            //     $time_work_diff = [];
            // }
        }


        // calculate $time_rest
        for ($i = 0; $i < count($attendance_rests); $i++) {
            foreach ($attendance_rests[$i]->rests as $j) {
                // if (isset($j["start_rest"])) {
                $rest_diff = strtotime($j["finish_rest"]) - strtotime($j["start_rest"]);
                // }else{
                // $rest_diff = 0;
                // }
                $rest_each[] = $rest_diff;
            }
            $rest_sum = array_sum($rest_each);
            $rest_hour = floor($rest_sum / 3600);
            $rest_minute = floor(($rest_sum % 3600) / 60);
            $rest_second = floor($rest_sum % 60);
            $time_rest[] = $rest_hour . ":" . $rest_minute . ":" . $rest_second;
            $rest_each = [];
        }

        // calculate $time_work
        for ($i = 0; $i < count($time_work_diff); $i++) {
            $work_rest = strtotime($time_work_diff[$i]) - strtotime($time_rest[$i]);
            $work_hour = floor($work_rest / 3600);
            $work_minute = floor(($work_rest % 3600) / 60);
            $work_second = floor($work_rest % 60);
            $time_work[] = $work_hour . ":" . $work_minute . ":" . $work_second;
        }


        // create $attendances
        for ($i = 0; $i < count($name); $i++) {
            $person = [
                "name" => $name[$i],
                "work_date" => $work_date[$i],
                "start_work" => $start_work[$i],
                "finish_work" => $finish_work[$i],
                "time_rest" => $time_rest[$i],
                "time_work" => $time_work[$i],
            ];
            $attendances[] = $person;
        }


        // pagenation of $attendances 
        $attendances = collect($attendances);
        $attendances = new LengthAwarePaginator(
            $attendances->forPage($request->page, 5),
            count($attendances),
            5,
            $request->page,
            array('path' => $request->url()),
        );
        return view("attendance_user", compact("attendances"));
    }
}


?>