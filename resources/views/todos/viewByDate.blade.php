@extends('layouts.master')

@section('css')
    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }

        a, a:hover {
            color: white;
        }

        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

@section('sidebar')
         @include('layouts.sidebar')    
@endsection

@section('content')
    <div id="content">
        @include('todos.taskWithCat')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>

@endsection

@section('js')
    <script src="{{asset('/js/ajax-modal-form.js')}}"></script>
    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>
@endsection