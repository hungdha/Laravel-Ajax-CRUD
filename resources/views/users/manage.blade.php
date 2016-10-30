@extends('layout')
@section('maincontent')
    <div class="user">
        <h2>Users List</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New User</button>
        <div>
            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="users-list" name="users-list">
                    @foreach ($users as $user)
                    <tr id="user{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$user->id}}">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete delete-user" value="{{$user->id}}">Delete</button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->


            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">User Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmUsers" name="frmUsers" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="name" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="" />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="email" class="col-sm-3 control-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">Password:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-conf" class="col-sm-3 control-label">Password Confirm:</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password-conf" name="password-conf" placeholder="Password Confirm" value="" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" >Cancel</button>                        
                            <input type="hidden" id="user_id" name="user_id" value="0" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal-->
    </div>

    <script src="{{asset('js/user-ajax.js')}}"></script>
</div>
@endsection