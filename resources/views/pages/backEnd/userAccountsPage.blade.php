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
                <h1 class="page-header">User accounts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div ng-repeat="user in users">
                    <div class="col-sm-12 user_account_div">

                        <div class="col-sm-9">
                            <div class="col-sm-12">
                                <strong>User ID:</strong>
                                <% user.id %>
                            </div>

                            <div class="col-sm-12">
                                <strong>User name:</strong>
                                <% user.name %>
                            </div>

                            <div class="col-sm-12">
                                <strong>Role:</strong>
                                <% user.role %>
                            </div>

                            <div class="col-sm-12">
                                <strong>User email:</strong>
                                <% user.email %>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-sm-12">
                                <button class="btn btn-full-width btn-primary" data-toggle="modal" ng-click="setSelectUser(user)" data-target="#myModal">Edit User</button>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <button class="btn btn-full-width btn-danger" ng-click="deleteUser(user.id)">Delete User</button>
                            </div>

                        </div>

                    </div>

                </div>
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


                                <!-- -------------------------------- CONFIRM PASSWORD ------------------------------------------------------------- -->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>

                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="confirm_password"
                                               name="confirm_password"
                                               placeholder="Confirm Password"
                                               ng-model="selectedUser.confirmpassword" ng-required="true">

                                    <span class="help-inline c-red"
                                          ng-show="frmEmployees.confirm_password.$invalid && frmEmployees.confirm_password.$touched">Please type the password again</span>

                                <span class="help-inline c-red"
                                      ng-show="selectedUser.password != selectedUser.confirmpassword && frmEmployees.confirm_password.$valid">Mismatching passwords</span>
                                    </div>
                                </div>

                            </form>
                            <!-- -------------------------------- FORM END ------------------------------------------------------------- -->



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary p-l-30 p-r-30" id="btn-save" ng-click="adminSave()"
                                ng-disabled="frmEmployees.$invalid">Create Account
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection