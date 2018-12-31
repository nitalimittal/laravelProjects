<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use response;
use Illuminate\support\Facedes\input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }

    public function index(Project $project, Request $request){

        $projects =  Project::userProjects();
        $showAll = false;
        if ($request->ajax())
            return view('todos.index',compact('projects', 'project','showAll'));
        else
            return view('todos.ajax',compact('projects', 'project','showAll'));
    }

    public function create(Project $project)
    {
        if (request()->isMethod('get'))
        {
            return view('todos.form',compact('project'));
        }
        else {
            $rules = [
                'title' => 'required',
            ];

            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors(),
                    'duplicate' => false
                ]);


            $success = $project->addTask(request()->all());

            if (!$success)
            {
                return response()->json([
                    'fail' => true,
                    'duplicate' => true
                ]);
            }


            return response()->json([
                'fail' => false,
                'redirect_url' => url("/projects/".request('project_id')),
                'duplicate' => false
            ]);
        }
    }

    public function delete(Task $task)
    {
        Task::findorFail($task->id)->delete();
        return redirect("/projects/".$task->project_id);
    }

    
    public function update(Request $request, $id)
    {
        if ($request->isMethod('get'))
        {
            $task = Task::find($id);
            return view('todos.form', compact('project', 'task'));
        }
        else {
            $rules = [
                'title' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json([
                    'fail' => true,
                    'errors' => $validator->errors(),
                    'duplicate' => false
                ]);
            
            $task = Task::find($id);
            $request->project_id = $task->project_id;
            $duplicate = Task::isDuplicateTask($request);
            if ($duplicate)
                return response()->json([
                    'fail' => true,
                    'duplicate' => true 
                ]);
            
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();
            return response()->json([
                'fail' => false,
                'redirect_url' => url("/projects/".$task->project_id),
                'duplicate' => false
            ]);
        }
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('todos.showTask', compact('task'));
    }

    public function toggleTaskStatus($id, $completed)
    {
        $task = Task::find($id);
        $task->completed = $completed;
        $task->save();
        return response()->json([
            'redirect_url' => url("/projects/".$task->project_id),
        ]);
    }

    public function showAll(Project $project, Request $request)
    {
        $projects =  Project::userProjects();
        $showAll = true;

        if ($request->ajax())
            return view('todos.index',compact('projects', 'project', 'showAll'));
        else
            return view('todos.ajax',compact('projects', 'project', 'showAll'));
    }

    public function tasksToday(Project $projects)
    {
        //dd("hi");
        //$this->tasksByDate(Carbon::today());
    }

    public function tasksByDate(Project $projects, $date)
    {
        $projects =  Project::userProjects();
        $tasks = Task::userTasks();
        $tasks = $tasks->where('due_date',$date);

        return view('todos.viewByDate',compact('projects', 'tasks'));

    }

}