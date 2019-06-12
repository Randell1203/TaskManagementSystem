<?php
namespace App\Utilities;

trait ApplicationMessages
{
	protected function formatMessage(array $data){
		 
	}

	protected function getStatusMessage( int $status_code, String $message='Successfuly Updated' ){

		$response['message'] = $status_code;
		$response['status_code'] = $message;

		return $response;
	}


}