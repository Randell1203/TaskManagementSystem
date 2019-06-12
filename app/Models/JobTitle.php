<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $table = 'job_title';


    public function department(){
        return $this->hasOne(\App\Models\Department::class, 'id', 'department_id');
    }
}
