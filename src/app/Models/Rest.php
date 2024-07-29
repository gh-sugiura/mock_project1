<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        // "attendance_id",
        "start_rest",
        "finish_rest",
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }


    // public function restTime()
    // {
    //     $rest_time = Rest::select('post_id')
    //     ->selectRaw('SUM(amount) AS total_amount')
    //     ->groupBy("created_at")
    //     ->groupBy("uesr_id")
    //     ->get();
    //     return $rest_time;
    // }
}


?>