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


    public function rests()
    {
        return $this->hasMany("App\Models\Rest");
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


?>