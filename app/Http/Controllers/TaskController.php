<?php


namespace App\Http\Controllers;

use App\Services\TaskApiService;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    protected $TaskApiService;

    public function __construct(TaskApiService $TaskApiService)
    {
        $this->TaskApiService = $TaskApiService;
    }

    public function index()
    {
        $todos = $this->TaskApiService->getTodos();

        //convert the duedate to string representation making it more readable
        foreach ($todos as $todo) {
            $todo->due_date = \Carbon\Carbon::parse($todo->due_date)->isoFormat('dddd, MMMM Do YYYY, h:mm a');
        }

        return $todos;
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {

        $data = $request->all();

        if ($data['sub_tasks'] !== 'no') {
            foreach ($data['subtasks'] as $key => $subtask) {
                $data['subtasks'][$key] = ['title' => $subtask, 'completed' => false];
            }
        } else {
            $data['subtasks'] = [];
        }

        // Merge date and time
        $dateTime = \Carbon\Carbon::parse($data['due_date'] . ' ' . $data['time']);

        // Format the merged date and time
        $data['due_date'] = $dateTime->format('Y-m-d\TH:i:s.v\Z');

        // create the task
        $this->TaskApiService->createTodo($data);


        // redirect to dashboard with session success message
        return redirect()->route('dashboard')->with('message', 'Task created successfully!');
    }
    public function show($id)
    {
        $todo = $this->TaskApiService->getTodos($id);
        return response()->json($todo);
    }

    public function edit($id)
    {
        $todo = $this->TaskApiService->getTodos()[$id];
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if (array_key_exists('due_date', $data)) {
            // Merge date and time
            $dateTime = \Carbon\Carbon::parse($data['due_date'] . ' ' . $data['time']);

            // Format the merged date and time
            $data['due_date'] = $dateTime->format('Y-m-d\TH:i:s.v\Z');
        }

        $this->TaskApiService->updateTodo($id, $data);

        return response()->json(['message' => 'Task updated successfully!']);
    }

    public function destroy($id)
    {
        $this->TaskApiService->deleteTodo($id);
        return response()->json(['message' => 'Task deleted successfully!']);
    }

    public function subtasks_push($id)
    {
        $data = request()->all();
        //convert title to an array
        $array = [
            [
                "title" => $data['title']
            ]
        ];

        $task = $this->TaskApiService->addOrUpdateSubtask($id, $array);
        return redirect()->route('dashboard')->with('message', $task['msg'] ?? 'Subtask added successfully!');
    }

    public function subtask_update($id)
    {
        $data = request()->all();
        $task = $this->TaskApiService->markSubTaskAsComplete($id, $data['subtask']);

        return response()->json(['message' => 'Subtask marked completed!']);
    }
}

