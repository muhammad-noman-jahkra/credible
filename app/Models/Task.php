<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function TaskMeta(){
        return $this->hasMany('App\Models\TaskMeta','task_id','id');
    }
    
    public function LastTaskMeta(){
        return $this->hasOne('App\Models\TaskMeta','task_id','id')->latestOfMany();
    }
    
    public function TaskAttachments(){
        return $this->hasMany('App\Models\TaskAttachements','task_id','id');
    }
}
