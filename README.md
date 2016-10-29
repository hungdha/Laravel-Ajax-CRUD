# Laravel-Ajax-CRUD
Laravel version 5.3 lastest

#Model View Controller
## Model
```
namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task', 'description','done'];
}
```
## View
```
 @foreach ($tasks as $task)
<tr id="task{{$task->id}}">
    <td>{{$task->id}}</td>
    <td>{{$task->task}}</td>
    <td>{{$task->description}}</td>
    <td>{{$task->created_at}}</td>
    <td>
        <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$task->id}}">Edit</button>
        <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$task->id}}">Delete</button>

    </td>
</tr>
@endforeach
```
## Controller
```
class TaskController extends Controller
{

	public function index(){		
	    $tasks = Task::all();        
	    return \View::make('tasks.manage')->with('tasks',$tasks)->with('title' , 'Tasks List' );
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
```
