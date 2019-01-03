
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keyword" content="todoApp"">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todo App</title>

    <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ URL::to('css/app.css') }}" rel="stylesheet">
        <link href="{{ URL::to('css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    

      <!--right slidebar-->
      <link href="{{ URL::to('css/slidebars.css') }}" rel="stylesheet">

      <!-- Custom styles for this template -->
    <link href="{{ URL::to('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to('css/style-responsive.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
  </head>

  <body>

    <section id="container" class="">
        @include('layouts.header')

        @yield('css')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" 
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" 
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        @yield('js')


        @yield('sidebar')

        @if($flash = session('message'))
            <div class="alert alert-success" role="alert">
                {{$flash}}
            </div>
        @endif
        
        {{--  @include('layouts.sidebar')  --}}
    
        <!--main content start-->
        @yield('content')
        <!--main content end-->
        
        @include('layouts.footer')
    </section>

  </body>
</html>
