
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel tasks-widget">
                        <header class="panel-heading">
                            <span>Today's Tasks</span></span>
                        </header>
                        <div class="panel-body">

                            <div class="task-content">

                                <ul class="task-list" id="tasklist">
                                    @foreach($tasks as $task)
                                        <li>
                                            <a class="catlink" href="{{ url('/projects/'.$task->project->id)}}"> {{$task->project->name}} </a>
                                            @include('todos.task') 
                                        </li>
                                    @endforeach
            
                                </ul>
                            </div>

                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>
    </section>


