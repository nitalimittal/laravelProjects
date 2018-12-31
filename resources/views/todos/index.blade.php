
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel tasks-widget">
                        <header class="panel-heading">
                            <span>{{$project->name}} Tasks</span>
                            <a class="btn-medium btn-danger btn-sm pull-right" 
                             href="{{($project->tasks()->count() == 0 || $project->tasks()->Incomplete()->count() == 0)?
                                '#modalDelete' : '#modalDeleteError' }}" data-toggle="modal"
                                data-id="{{$project->id}}" data-token="{{csrf_token()}}" data-type="project">Delete Category</a>
                        </header>
                        <div class="panel-body">

                            <div class="task-content">

                                <ul class="task-list" id="tasklist">
                                    @foreach($project->tasks()->get() as $task)
                                        @if($showAll || !$task->completed)
                                            <li>
                                                @include('todos.task') 
                                            </li>
                                        @endif
                                    @endforeach
            
                                </ul>
                            </div>

                            <div class="add-task-row task-btn-div">
                                @if($showAll) {{--if all tasks are shown--}}
                                    <a class="btn-big btn-info btn-sm pull-right"  id="ajaxRedirect"
                                        href="{{url('/projects/'.$project->id)}}">Back</a>
                                @else
                                <a class="btn-big btn-success btn-sm pull-left" href="#modalForm" data-toggle="modal" 
                                    data-href="{{url('/projects/'.$project->id.'/create')}}">Add New Task</a>
                                <a class="btn-big btn-info btn-sm pull-right"  id="ajaxRedirect"
                                    href="{{url('/projects/'.$project->id.'/showAll')}}">See All Tasks</a>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>
    </section>


