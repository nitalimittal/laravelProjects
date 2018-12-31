  <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                            <span class="sidebar-heading"> Categories </span>
                    </li>
                    @foreach($projects as $proj)
                        <li>
                            <a href="/projects/{{ $proj->id }}" class="
                                @if(isset($project) && ($project->id == $proj->id))
                                    {{'active'}}
                                @endif
                            ">
                                <span> {{$proj->name}}</span>
                                <div class="float-right">
                                  <span class="badge badge-sm label-primary">{{$proj->tasks->count()}}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <form class="addcatform" action="{{url('/projects/add')}}" method="POST">
                            {{csrf_field()}}
                            <button type="submit">+</button>
                            <input type="text" name="name" placeholder="Add Category" class="'form-control'.($errors->has('title')?' is-invalid':''"/>
    
                            @if(count($errors))
                            	<div class="form-group">
                            		<div class="invalid-feedback">
                            			<ul>
                            				@foreach($errors->all() as $error)
                            					<li> {{ $error }} </li>
                            				@endforeach
                            			</ul>
                            		</div>
                            	</div>
                            @endif

                        </form>  
                    </li>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->