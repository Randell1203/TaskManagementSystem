<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['middleware' => ['auth']], function () {
   Route::get('/', function () {
       return view('dashboard');
   });
});




/*
|--------------------------------------------------------------------------
| GENERAL ROUTES START
|--------------------------------------------------------------------------
*/
	Route::get('/getDefaultData','AppController@getDefaultData');
	Route::get('/getJobTitleListByDepartmentId','AppController@getJobTitleListByDepartmentId');
	Route::get('/getUsersListByDeparment','AppController@getUsersListByDeparment');
	

/*
|--------------------------------------------------------------------------
| GENERAL ROUTES END
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| AUTH ROUTES START
|--------------------------------------------------------------------------
*/

// Auth::routes();

Route::group(['middleware' => ['web']], function () {
	Route::post('/logout','Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['web','guest']], function () {
   	Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
	Route::post('/login','Auth\LoginController@login')->name('login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES END
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| USERS ROUTES START
|--------------------------------------------------------------------------
*/
	Route::group(['middleware' => ['auth','isAdmin']], function () {
		Route::get('users', function () {
		    return view('users');
		})->name('users');
	});

	Route::get('/getUserList','Users\UsersController@getUserList');
	Route::post('/createUser','Users\UsersController@createUser');
	Route::put('/updateUser','Users\UsersController@updateUser');



/*
|--------------------------------------------------------------------------
| USERS ROUTES END
|--------------------------------------------------------------------------
*/




/*
|--------------------------------------------------------------------------
| DASHBOARD START
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', function () {
	    return view('dashboard');
	})->name('dashboard');
});



/*
|--------------------------------------------------------------------------
| DASHBOARD END
|--------------------------------------------------------------------------
*/






/*
|--------------------------------------------------------------------------
| TASKS ROUTES START
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {

    Route::get('tasks', function () {
        return view('tasks');
    })->name('tasks');

    Route::get('/getAllTasks','Tasks\TasksController@getAllTasks');
    Route::post('/createTask','Tasks\TasksController@createTask');
    Route::get('/getUserTask','Tasks\TasksController@getUserTask');

});
    Route::put('/updateTask','Tasks\TasksController@updateTask');

/*
|--------------------------------------------------------------------------
| TASKS ROUTES END
|--------------------------------------------------------------------------
*/