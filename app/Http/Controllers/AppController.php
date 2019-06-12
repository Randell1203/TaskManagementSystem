<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\ModelRequests;


class AppController extends Controller
{
	use ModelRequests;

    public function getDefaultData(Request $request){
    	$data = $request->all();
    	$response = $this->getListOfData($data);
    	return $response;
    }

    // Get list of job title of a department
    public function getJobTitleListByDepartmentId(Request $request){
    	$data = $request->all();
    	$response = $this->jobTitleListByDepartmentId($data['id']);
    	return $response;
    }

    // Get all users for dropdown list
    public function getUsersListByDeparment(Request $request){
        $data = $request->all();
        $response = $this->usersListByDeparmentId($data['id']);
        return $response;    
    }

    
}
