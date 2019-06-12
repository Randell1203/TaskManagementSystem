<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

use App\Utilities\ApplicationMessages;


class UsersController extends Controller
{
	use ApplicationMessages;

	public function getUserList(){
		$users = User::all();

		return $users->toJson();
	}

    public function createUser(Request $request){

    	$data = $request->all();

		Validator::make($data, [
                'firstName' => ['required', 'string', 'max:191'],
                'middleName' => ['max:191'],
                'lastName' => ['required', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
                'username' => ['required', 'string', 'max:191', 'unique:users'],
                'contactNo' => [ 'max:50'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:6'],
                'userType' => ['required', 'numeric'],
                'department' => ['required', 'numeric'],
                'jobTitle' => ['required', 'numeric'],
            ])->validate();


        // Validation passed
    	try{
    		$user =  User::create([
    		    'first_name' => $data['firstName'],
    		    'middle_name' => $data['middleName'],
    		    'last_name' => $data['lastName'],
    		    'username' => $data['username'],
    		    'user_type' => $data['userType'],
    		    'department' => $data['department'],
                'job_title' => $data['jobTitle'],
    		    'mobile_no' => $data['contactNo'],
    		    'email' => $data['email'],
    		    'status' => 1,
    		    'added_by_id' => Auth::user()->id,
    		    'password' => Hash::make($data['password']),
    		]);

    		if($user->save()){
    			return $user;
    		}

    	}catch (\Exception $e){
    		return $e->getMessage();
    	}
    }

    public function updateUser(Request $request){

    	$data = $request->all();

    	Validator::make($data, [
    	    	    'firstName' => ['required', 'string', 'max:191'],
    	    	    'middleName' => [ 'max:191'],
    	    	    'lastName' => ['required', 'string', 'max:191'],
    	    	    'email' => 'required| string | email | max:191 | unique:users,email,'. $data['id'] ,
    	    	    'username' => ['required', 'string', 'max:191', 'unique:users,username,'.$data['id']],
    	    	    'contactNo' => ['max:50'],
    	    	    'userType' => ['required', 'numeric'],
    	    	    'department' => ['required', 'numeric'],
    	    	    'jobTitle' => ['required', 'numeric'],
    	    	])->validate();

        // Validation passed
        try{

            $user = User::find($data['id']);

            $user->first_name = $data['firstName'];
            $user->middle_name = $data['middleName'];
            $user->last_name = $data['lastName'];
            $user->user_type = $data['userType'];
            $user->mobile_no = $data['contactNo'];
            $user->email = $data['email'];
            $user->department = $data['department'];
            $user->job_title = $data['jobTitle'];
            $user->updated_by_id = Auth::user()->id;
            $user->save();

            if($user->save()){
                return $user;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }


}
