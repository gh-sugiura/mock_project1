<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "start_work",
        "finish_work",
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getName()
    {
        return optional($this->user)->name;
    }


    public function workTime()
    {
        if(isset($this->finish_work)) {
            $work_diff = (strtotime($this->finish_work) - strtotime($this->start_work));
            $work_hour = floor($work_diff / 3600);
            $work_minute = floor(($work_diff % 3600) / 60);
            $work_second = floor($work_diff % 60);
            return $work_hour . ":" . $work_minute . ":" . $work_second;
        }
        
    }
}


?>