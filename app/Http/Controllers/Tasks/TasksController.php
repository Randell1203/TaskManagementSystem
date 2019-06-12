<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Validator;
use App\Utilities\ModelRequests;
use Auth;

class TasksController extends Controller
{
    use ModelRequests;
    public function getAllTasks(Request $request){

        $data = $request->all();
     
        Validator::make($data, [
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
        ])->validate();

        $tasks = $this->getTasksList($data);
    	return $tasks->paginate('5');
    }

    public function getUserTask(Request $request){
        $data = $request->all();
        $user_id = Auth::user()->id;
        $userTasks = Task::where('assigned_to', '=', $user_id)
                        ->get()
                        ->toArray();

        $formattedTasks = $this->getTasksStatusList($userTasks);

        return $formattedTasks;
    }

    public function createTask(Request $request){

    	$data = $request->all();

        $attributes = array(
            'taskName' => 'task name',
            'status' => 'status',
            'department'  => 'department',
            'assignedEmployee'  => 'assign to',
            'deadline'  => 'deadline',
            'description'  => 'description',
        );

        Validator::make($data, [
            'taskName' => ['required', 'string', 'max:191'],
            'department' => ['required', 'numeric'],
            'assignedEmployee' => ['required', 'numeric'],
            'status' => ['required', 'numeric'],
        ],[],$attributes)->validate();

        try{
            $task = Task::create([
                'task_title' => $data['taskName'],
                'description' => $data['description'],
                'department_id' => $data['department'],
                'assigned_to' => $data['assignedEmployee'],
                'added_by_id' => Auth::user()->id,
                'status' => $data['status'],
                'deadline' => Carbon::now()->format('Y-m-d h:i:a'),
            ]);

            return $task;

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTask(Request $request){

        $data = $request->all();
        // Validator::make($data, [
        //             'firstName' => ['required', 'string', 'max:191'],
        //             'middleName' => [ 'max:191'],
        //             'lastName' => ['required', 'string', 'max:191'],
        //             'email' => 'required| string | email | max:191 | unique:users,email,'. $data['id'] ,
        //             'username' => ['required', 'string', 'max:191', 'unique:users,username,'.$data['id']],
        //             'contactNo' => ['max:50'],
        //             'userType' => ['required', 'numeric'],
        //             'department' => ['required', 'numeric'],
        //             'jobTitle' => ['required', 'numeric'],
        //         ])->validate();

        // Validation passed
        try{

            $task = Task::find($data['id']);

            $task->task_title = $data['taskName'];
            $task->description = $data['description'];
            $task->department_id = $data['department'];
            $task->assigned_to = $data['assignedEmployee'];
            $task->status = $data['status'];
            $task->start_date = $this->dateTimeFormat($data['date_started']);
            $task->deadline = $this->dateTimeFormat($data['deadline']);
            $task->updated_by_id = Auth::user()->id;
           
            $task->save();

            if($task->save()){
                $userTasks = Task::where('assigned_to', '=', $data['id'])
                                ->get()
                                ->toArray();

                $formattedTasks = $this->getTasksStatusList($userTasks);

                return $formattedTasks;
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }


    protected function getTasksStatusList($tasksList){
        $formattedTasks = array(
            'PENDING' => array(),
            'ONGOING' => array(),
            'FINISHED' => array(),
            'DELAYED' => array(),
        );


        foreach ($tasksList as $key => $value) {
            if($value['status'] == 1){
                // Pending
                $formattedTasks['PENDING'][] = $value;
            }else if($value['status'] == 2){
                //Ongoing
                $formattedTasks['ONGOING'][] = $value;

            }else if($value['status'] == 3){
                //Finished
                $formattedTasks['FINISHED'][] = $value;

            }else if($value['status'] == 4){
                //Delayed
                $formattedTasks['DELAYED'][] = $value;

            }
        }

        return $formattedTasks;
    }
   

   
}
