<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Attendance extends Model
{
    use HasFactory;

    public function Employee(){
        return $this->hasOne('App\Models\employee','id','user_id');
    }


    protected $fillable = ['in_time','out_time'];


    public function calAttendanceWorkingHour(){
        $start_datetime = new DateTime($this->in_time); 
        // dd(date("Y-m-d H:i:s"));
        $diff = $start_datetime->diff(new DateTime(!empty($this->out_time) ? $this->out_time: $start_datetime)); 
// dd([$diff,$start_datetime,new DateTime(!empty($this->out_time) ? $this->out_time: date("Y-m-d H:i:s"))]);
        $total_hr = ($diff->days * 24); 
        $total_hr += $diff->h; 
        $total_hr += $diff->i / 60; 
        
        return round($total_hr,2);
    }
}
