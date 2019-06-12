<?php
namespace App\Utilities;

use App\Models\JobTitle;
use App\Models\Task;
use App\Models\Department;

use App\User;

use App\Utilities\Core;
use Auth;


trait ModelRequests
{
	use Core;

	protected function getModelList($model){
		$data = array();
		switch (strtolower($model)) {
			case 'department':
				$data = Department::select('id','name')
					->get()
					->keyBy('id')
					->toArray();
				break;

			case 'job_title':
				$data = JobTitle::all()->toArray();
				break;

			case 'user_type':
				$userTypeList = $this->getUserTypeList();
				foreach ($userTypeList as $key => $value) {
					$data[] = array(
						'id' => $key,
						'role' => $value,
					);
				}
				break;


			case 'task_status':
				$taskStatusList = $this->getTaskStatusList();

				foreach ($taskStatusList as $key => $value) {
					$data[] = array(
						'id' => $key,
						'status' => $value,
					);
				}
				break;
		}

		return $data;
	}


	protected function getListOfData($arrayData){
		$listOfData = array();
		foreach ($arrayData as $key => $value) {
			$listOfData[$value] = $this->getModelList($value);
		}
		return $listOfData;
		
	}

	protected function jobTitleListByDepartmentId($department_id){
			return JobTitle::select('id','name')
							->where('department_id', $department_id)
							->get()
							->keyBy('id')
							->toArray();

	}


	protected function getUserTask($data){

	    $user_id = Auth::user()->id;
	    $userTasks = Task::where('assigned_to', '=', $user_id)
	                    ->get()
	                    ->toArray();

	    $formattedTasks = $this->getTasksStatusList($userTasks);

	    return $formattedTasks;
	}

	// Get users for drop down list
	protected function usersListByDeparmentId($department_id){

		 return $users = User::where('department', $department_id)
					->get()
					->keyBy('id')
					->toArray();
	}


	// Get task list with filter
	protected function getTasksList($data){

		$date_from = $this->dateFormat($data['date_from']);
		$date_to = $this->dateFormat($data['date_to']);
		$date_started = $this->dateFormat($data['date_started']);
		$deadline = $this->dateFormat($data['deadline']);


		// Date Created Filter
		$query = Task::whereDate('created_at', '>=', $date_from)
		                ->whereDate('created_at', '<=', $date_to);

		// Date Started Filter
		if($date_started){
		    $query = $query->whereDate('start_date', '=', $date_started);
		}

		// Deadline Filter
		if($deadline){
		    $query = $query->whereDate('deadline', '=', $deadline);
		}

		// Status Filter
		if($data['status'] != 0){
		    $query = $query->where('status', '=', $data['status']);
		}

		$user = Auth::user();

		// Team member or team leader
		if($user->user_type == 3 || 4){
			$data['department']	= $user->department;

			// Team member
			if($user->user_type == 4){
				$data['assigned_to'] = $user->id;
			}
		}



		// Department Filter
		if($data['department'] != 0){
		    $query = $query->where('department_id', '=', $data['department']);
		}

		// Assigned to filter
		if($data['assigned_to'] != 0){
		    $query = $query->where('assigned_to', '=', $data['assigned_to']);
		}

		return $query;

	}




}