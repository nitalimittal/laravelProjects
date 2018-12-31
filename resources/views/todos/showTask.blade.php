
<div class="modal-header">
    <h5 class="modal-title">View Task</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div>
        <div class="show-heading"> Title: </div>
        <div class="show-data">{{$task->title}}</div>
    </div>
    <div>
        <div class="show-heading"> Description: </div>
        <div class="show-data">{{$task->description}}</div>
    </div>
    <div>
        <div class="show-heading"> Due Date: </div>
        <div class="show-data">{{\Carbon\Carbon::parse($task->due_date)->format('d/m/Y')}}</div>
    </div>
    <div>
        <div class="show-heading"> Status: </div>
        @if($task->completed)
            <div class="show-data" style="color:green">Completed</div>
        @else 
            <div class="show-data" style="color:red">Pending</div>
        @endif
    </div>    
</div>
<div class="modal-footer">
    <button type="button" class="btn-medium btn-secondary" data-dismiss="modal">Close</button>
    {{-- <button id="edit" type="button" class="btn btn-danger">
        Edit
    </button> --}}
</div>
