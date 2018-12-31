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

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal_content"></div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                    <input type="hidden" id="delete_token" name="delete_token" value=""/>
                    <input type="hidden" id="delete_id" name="delete_id" value=""/>
                    <input type="hidden" id="delete_type" name="delete_type" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-medium btn-secondary" data-dismiss="modal">Close</button>
                    <button id="delete" type="button" class="btn-medium btn-danger">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDeleteError" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:red">Please make sure the project is empty or all tasks are completed.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-medium btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDuplicateError" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Duplicate Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="color:red">Task already exists!!!!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-medium btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        @include('todos.index')
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