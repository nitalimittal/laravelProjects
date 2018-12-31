<div class="task-title" 
    @if($task->completed)
        style="text-decoration: line-through"
    @endif>
    <span class="task-title-sp">{{$task->title}}</span>
    <span class="badge badge-sm
        @if($task->isTaskDueToday())
            {{'label-warning'}}
        @elseif($task->isTaskOverDue())
            {{'label-danger'}}
        @else
            {{'label-success'}}
        @endif">
        {{$task->getDate()}}
    </span>
    <div class="float-right">
        <button class="btn {{$task->completed ?'btn-danger': 'btn-success' }} btn-xs" title="Mark {{$task->completed ?'Incomplete': 'Completed' }}" id="toggleStatus"
            data-id="{{$task->id}}" data-completed="{{$task->completed}}">
            <span><img src="{{$task->completed ? URL::to('img/revert.png') : URL::to('img/check.png') }}"></img></span>
        </button>
        <button class="btn btn-warning btn-xs" title="Show Task" href="#modalForm"
            data-toggle="modal" data-href="{{url('/show/'.$task->id)}}">
            <span><img src="{{ URL::to('img/show.png') }}"></img></span>
        </button>
        <button class="btn btn-primary btn-xs" title="Edit" href="#modalForm" 
            data-toggle="modal" data-href="{{url('/update/'.$task->id)}}">
            <img src="{{ URL::to('img/edit.png') }}"></img>
        </button>
        <button class="btn btn-danger btn-xs" title="Delete" data-toggle="modal"
                href="#modalDelete"
                data-id="{{$task->id}}"
                data-token="{{csrf_token()}}"
                data-type="task">
            <img src="{{ URL::to('img/delete.png') }}"></img>
        </button>
    </div>
</div>