<!--header start-->
      <header class="header white-bg">
          <!--logo start-->
          <a href="/" class="logo" >ToDo<span>App</span></a>
          <!--logo end-->

          <div class="top-nav">
            <div class="float-right">
              <ul class="nav pull-right top-menu">
                @guest
                    <li>
                      @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <span class="username">Sign Up</span>    
                        </a>
                      @endif
                      <a href="{{ route('login') }}">
                            <span class="username">Login</span>
                      </a>
                    </li>
                @else
                    <li>    
                        <a class="sideheadbutton" href="{{ url('/date/'.Carbon\Carbon::today())}}">
                                <span class="username">Today's Task</span>
                        </a>
                        <a class="sideheadbutton" href="{{ url('/date/'.Carbon\Carbon::tomorrow())}}">
                            <span class="username">Tomorrow's Task</span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="username">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
              </ul>
            </div>
          </div>
      </header>
      <!--header end-->