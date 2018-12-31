<?php

namespace App;
use Carbon\Carbon;

class Task extends Model
{
    public function project()
	{
		return $this->belongsTo(Project::class);
    }
    
    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0);
    }

    public function getDate()
    {
        $created = new Carbon($this->due_date);
        $now = Carbon::today();
        if($created->diffInYears($now) > 0)
        {
            $difference = $created->diffInYears($now);
            $difference = ($difference == 1)? $difference.' Year':$difference.' Years';
        }   
        else if($created->diffInMonths($now) > 0)
        {
            $difference = $created->diffInMonths($now);
            $difference = ($difference == 1)? $difference.' Month':$difference.' Months';
        }  
        else
        {
            $difference = $created->diffInDays($now);
            $difference = ($difference == 1)? $difference.' Day':$difference.' Days';
        }

        if($created->diff($now)->days <1)
            $difference = 'Due Today';
        else
            $difference = ($created->gt($now)) ? $difference.' Left': $difference.' Due';

        return $difference;
    }

    public function isTaskDueToday()
    {
        $created = new Carbon($this->due_date);
        $now = Carbon::today();
        return ($created->diff($now)->days <1 ? true:false);
    }

    public function isTaskOverDue()
    {
        $created = new Carbon($this->due_date);
        $now = Carbon::now();
        return ($created->lt($now));
    }

    public static function isDuplicateTask($request)
    {
        $count = \DB::table('tasks')->where([
            ['title', $request['title']],
            ['description', $request['description']],
            ['due_date', $request['due_date']],
            ['project_id',$request['project_id']]
        ])->count();
        return ($count > 0);
    }

    public static function userTasks()
    {
        $task = collect();
        $projects = Project::userProjects();
        
        foreach($projects as $project)
        {
            foreach($project->tasks as $tk)
                $task->push($tk);
        }
        //dd($task->count());
        return $task;
    }
}
