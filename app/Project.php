<?php

namespace App;

class Project extends Model
{
    public function tasks()
	{
		return $this->hasMany(Task::class);
    }

    public function user()
	{
        return $this->belongsTo(User::class);
    }

    public function addTask($request)
	{
        //dd($request['project_id']);
        if(!Task::isDuplicateTask($request))
        {
            Task::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'due_date' => $request['due_date'],
                'project_id' =>  $request['project_id']
            ]);
            return true;
        }
        return false;
    }
    
    public static function add($request)
	{
        //dd($request['project_id']);
		return Project::create([
            'name' => $request['name'],
            'user_id' => auth()->user()->id,
        ]);
    }
    
    public static function userProjects()
    {
        return  Project::where('user_id', auth()->user()->id)->get();
    }
}
