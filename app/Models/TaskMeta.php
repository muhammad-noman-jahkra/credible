<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMeta extends Model
{
    use HasFactory;

    public function TaskMetaEmployee(){
        return $this->hasOne('App\Models\Employee','id','claimBy');
    }
}
