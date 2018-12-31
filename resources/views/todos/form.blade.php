@if(isset($task))
    {!! Form::model($task,['method'=>'put','id'=>'frm','due_date'=>$task->due_date]) !!}
@else
    {!! Form::open(['id'=>'frm', 'project_id'=>$project->id, 'due_date'=>Carbon\Carbon::now()]) !!}
@endif
<div class="modal-header">
    <h5 class="modal-title">{{isset($task)?'Edit':'New'}} Task</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group row required">
        {!! Form::label("title","Title",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {!! Form::text("title",null,["class"=>"form-control".($errors->has('title')?" is-invalid":""),'placeholder'=>'Title','id'=>'focus']) !!}
            <span id="error-title" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row required">
        {!! Form::label("due_date","Completion Date",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {{-- {{ Form::text("due_date", null, ["class" => "form-control", "id"=>"datetimepicker"]) }} --}}
            {!! Form::date('due_date',(isset($task)? \Carbon\Carbon::parse($task->due_date) : Carbon\Carbon::now()),["class"=>"form-control".($errors->has('due_date')?" is-invalid":""),'id'=>'focus']) !!}
            <span id="error-due_date" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label("description","Description",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {!! Form::text("description",null,["class"=>"form-control".($errors->has('description')?" is-invalid":""),'placeholder'=>'Description']) !!}
            <span id="error-description" class="invalid-feedback"></span>
        </div>
    </div>
    @if(isset($task))
        {!! Form::hidden("project_id") !!}    
    @else
        {!! Form::hidden("project_id","$project->id") !!}
    @endif
    
</div>
<div class="modal-footer">
    <button type="button" class="btn-medium btn-danger" data-dismiss="modal"> Close</button>
    {!! Form::submit("Save",["class"=>"btn-medium btn-primary"])!!}
</div>
{!! Form::close() !!}