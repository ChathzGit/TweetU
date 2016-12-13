{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the user account page
--
--}}

@extends('pages.adminIndex')

@section('content')
    <div id="page-wrapper" ng-controller="adminUserAccountController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-right">User accounts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">

            <div class="col-sm-12 col-xs-12">
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>
                            User ID
                        </th>
                        <th>
                            User Name
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            User Email
                        </th>
                        <th>

                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="user in users">
                        <td>
                            <% user.id %>
                        </td>
                        <td>
                            <% user.name %>
                        </td>
                        <td>
                            <% user.role %>
                        </td>
                        <td>
                            <% user.email %>
                        </td>
                        <td>
                            <a href="" data-toggle="modal"
                               ng-click="setSelectUser(user)" data-target="#myModal">Edit</a>
                        </td>
                        <td>
                            {{--<button class="btn btn-full-width btn-danger" ng-click="deleteUser(user.id)">Delete--}}
                            {{--</button>--}}

                            <button data-toggle="modal"
                                    ng-click="setSelectUser(user)" data-target="#deleteConfirmModal"
                                    class="btn btn-full-width btn-danger">Delete
                            </button>
                            {{--data-toggle="modal"--}}
                            {{--ng-click="setSelectUser(user)" data-target="#myModal"--}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit User</h4>
                    </div>
                    <div class="modal-body">


                        <!-- -------------------------------- FORM START ------------------------------------------------------------- -->
                        <form name="frmEmployees" class="form-horizontal" novalidate="">


                            <!-- -------------------------------- NAME ------------------------------------------------------------- -->
                            <div class="form-group error">
                                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="name" name="name"
                                           placeholder="Fullname"
                                           ng-model="selectedUser.name" ng-required="true">
                                        <span class="help-inline c-red"
                                              ng-show="frmEmployees.name.$invalid && frmEmployees.name.$touched">Name field is required</span>
                                </div>
                            </div>


                            <!-- -------------------------------- EMAIL ------------------------------------------------------------- -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email Address"
                                           ng-model="selectedUser.email" ng-required="true">
                                        <span class="help-inline c-red"
                                              ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                </div>
                            </div>


                            <!-- -------------------------------- Role ------------------------------------------------------------- -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Role</label>

                                <div class="col-sm-9">
                                    <select ng-model="selectedUser.role" class="form-control">
                                        <option value="user">User</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                        <span class="help-inline c-red"
                                              ng-show="frmEmployees.role.$invalid && frmEmployees.role.$touched">Valid Email field is required</span>
                                </div>
                            </div>


                        </form>

                        <form name="passForm" class="form-horizontal" novalidate="">
                            <!-- -------------------------------- PASSWORD ------------------------------------------------------------- -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password"
                                           ng-model="selectedUser.password" ng-required="true">
                                    <span class="help-inline c-red"
                                          ng-show="frmEmployees.password.$invalid && frmEmployees.password.$touched">Password field is required</span>
                                </div>
                            </div>
                        </form>
                        <!-- -------------------------------- FORM END ------------------------------------------------------------- -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary p-l-30 p-r-30" id="btn-save" ng-click="adminSave()"
                                ng-disabled="frmEmployees.$invalid">Save Changes
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal -->
        <div id="deleteConfirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete User</h4>
                    </div>
                    <div class="modal-body">

                        <h5 class="text-center">Are you sure you want to delete "<% selectedUser.name %>"?</h5>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary p-l-30 p-r-30" data-dismiss="modal"
                                ng-click="deleteUser(selectedUser.id)">
                            Delete User
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection