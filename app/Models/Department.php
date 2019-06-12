<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = [
        'name',
        'description',
        'status',
        'added_by_id',
        'updated_by_id',
    ];


    public function jobTitle(){
        return $this->hasMany(\App\Models\JobTitle::class, 'department_id', 'id');

    }

    public function userInDepartment($userId){
        return true;
    }

}
