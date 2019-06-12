<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Utilities\Core;



class Task extends Model
{
    use Core;

	protected $table = 'tasks';
	// RESPONSE VALUE

    protected $fillable = [
    	'id',
    	'task_title',
    	'department_id',
    	'description',
    	'assigned_to',
    	'added_by_id',
    	'updated_by_id',
    	'status',
        'created_at',
        'updated_at',
        'start_date',
        'deadline',
    ];


    protected $hidden = [
        //Hide Relationship
        'taskDepartment', 'taskAssignedTo'

    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'deadline' => 'date:Y-m-d',
    ];

    /**************************************************/
    /* Additional Attributes
    /*************************************************/
    protected $appends = [
        'task_status','assigned_employee','department_name'
    ];
    /**************************************************/
    /* Accesors
    /*************************************************/
    
    public function getTaskStatusAttribute() {
        return $this->getTaskStatusList()[$this->status];
    }

    public function getDepartmentNameAttribute() {
        return $this->taskDepartment->name;
    }

    public function getAssignedEmployeeAttribute() {
        return $this->taskAssignedTo->first_name. ' '. $this->taskAssignedTo->last_name;
    }

    /**************************************************/
    /* Relationship
    /*************************************************/

    public function taskDepartment(){
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }

    public function taskAssignedTo(){
        return $this->belongsTo(\App\User::class, 'assigned_to', 'id');
    }
    
}
