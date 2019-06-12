<?php
namespace App\Utilities;

use Carbon\Carbon;
use Auth;

trait Core
{
	protected function getUserTypeList(){
		return $userTypeList = array(
			1 => 'Admin',
			2 => 'Manager',
			3 => 'Team Leader',
			4 => 'Team Member',
		);
	}

	protected function getUserType(int $user_type=4){
		$userTypeList = $this->getUserTypeList();
		return $userTypeList[$user_type];
	}

	protected function getTaskStatusList(){
		return $taskStatus = array(
			1 => 'PENDING',
			2 => 'ONGOING',
			3 => 'FINISHED',
			4 => 'DELAYED',
		);
	}

	protected function dateFormat($date){
		if($date != null || $date != '' ){
			return Carbon::parse($date)->format('Y-m-d');	
		}
		return $date;
	}

	protected function dateTimeFormat($date){
		if($date != null || $date != '' ){
			return Carbon::parse($date)->format('Y-m-d H:i:s');	
		}
		return $date;
	}

	protected function isAuthorized($user_type){
		$isAuthorized = false;
		return $isAuthorized;

	}
}