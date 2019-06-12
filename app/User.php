<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Utilities\Core;

class User extends Authenticatable
{
    use Notifiable;
    use Core;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'email',
        'user_type',
        'department',
        'job_title',
        'mobile_no',
        'password',
        'status',
        'added_by_id',
        'updated_by_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**************************************************/
    /* Additional Attributes
    /*************************************************/
    protected $appends = [
        'full_name',
        'added_by_name', 
        'updated_by_name',
        'department_name',
        'job_role',
        'user_type_priv'
    ];

    /**************************************************/
    /* Accesors
    /*************************************************/
    
    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    // user added by
    public function getAddedByNameAttribute() {
        $user = $this->find($this->added_by);

        if($user){
            return $user->first_name . ' ' . $user->last_name;
        }
    }
    // User updated by
    public function getUpdatedByNameAttribute() {
        $user = $this->find($this->updated_by);
        if($user){
            return $user->first_name . ' ' . $user->last_name;
        }
        
    }
    // User Department
    public function getDepartmentNameAttribute() {
        return $this->userDepartment->name;
        
    }

    // User Job Title
    public function getJobRoleAttribute() {
        return $this->userJobTitle->name;
    }

    // User Type Priv
    public function getUserTypePrivAttribute() {
        return $this->getUserType($this->user_type);
    }


    /**************************************************/
    /* Relationships
    /*************************************************/
    
    public function userDepartment(){
        return $this->hasOne(\App\Models\Department::class, 'id', 'department');
    }

    public function userJobTitle(){
        return $this->hasOne(\App\Models\JobTitle::class, 'id', 'job_title');
    }
    
}
