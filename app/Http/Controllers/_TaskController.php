<?php
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{

	public function index(){		
	    $tasks = Task::all();        
	    return View::make('tasks.manage')->with('tasks',$tasks)->with('title' , 'Tasks List' );
	}

	public function edit( $task_id ){
	    $task = Task::find($task_id);
	    return \Response::json($task);
	}

	public function store( Request $request ){
	    $task = Task::create($request->all());
	    return \Response::json($task);
	}
	public function create()
	{
		return null;
	}
	public function update( Request $request,$task_id )
	{		
	    $task = Task::find($task_id);
	    $task->task = $request->task;
	    $task->description = $request->description;
	    $task->save();
	    return \Response::json($task);
	}

	public function destroy( $id ){
		$task = Task::destroy($id);
    	sreturn \Response::json($task);
	}
}