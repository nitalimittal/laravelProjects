<?php

namespace App\Http\Controllers;
use response;
use Illuminate\support\Facedes\input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Project;
use App\Task;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home');
    }

    public function home(){
        if (auth()->check()) {
            return redirect('projects');
        }
		return view('todos.home');
    }

    public function projectView(Project $projects)
    {
        $projects = Project::userProjects();
        if(request()->ajax())
            return view('layouts.sidebar',compact('projects'));
        else
            return view('todos.projectView',compact('projects'));
    }

    public function add(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:15',
        ];

        $this->validate($request,$rules);

        $proj = Project::add($request->all());

        return redirect("/projects/".$proj->id);
    }

    public function delete(Project $project)
    {
        //dd("$project");
        foreach($project->tasks()->get() as $task)
            Task::findorFail($task->id)->delete();

        Project::findorFail($project->id)->delete();

        return redirect('projects');
    }
}
