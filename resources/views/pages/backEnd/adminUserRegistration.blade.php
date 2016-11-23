{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the usage details page
--
--}}

@extends('pages.adminIndex')

@section('content')
    {{--<div class="container" ng-controller="userAccountController">--}}

    <div id="page-wrapper" ng-controller="userAccountController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-right">Create User Account</h1>

                <div class="col-sm-10 col-xs-12">

                    <div class="col-sm-12 m-t-20">


                        <!-- -------------------------------- FORM START ------------------------------------------------------------- -->
                        <form name="frmEmployees" class="form-horizontal" novalidate="">


                            <!-- -------------------------------- NAME ------------------------------------------------------------- -->
                            <div class="form-group error">
                                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control has-error" id="name" name="name"
                                           placeholder="Fullname"
                                           ng-model="user.name" ng-required="true">
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
                                           ng-model="user.email" ng-required="true">
                                        <span class="help-inline c-red"
                                              ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                </div>
                            </div>


                            <!-- -------------------------------- Role ------------------------------------------------------------- -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Role</label>

                                <div class="col-sm-9">
                                    <select ng-model="user.role" class="form-control">
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
                                           ng-model="user.password" ng-required="true">
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
                                           ng-model="user.confirmpassword" ng-required="true">

                                    <span class="help-inline c-red"
                                          ng-show="frmEmployees.confirm_password.$invalid && frmEmployees.confirm_password.$touched">Please type the password again</span>

                                <span class="help-inline c-red"
                                      ng-show="user.password != user.confirmpassword && frmEmployees.confirm_password.$valid">Mismatching passwords</span>
                                </div>
                            </div>

                        </form>
                        <!-- -------------------------------- FORM END ------------------------------------------------------------- -->

                        <div class="col-sm-12 text-right m-b-20 p-0">
                            <button type="button" class="btn btn-primary p-l-30 p-r-30" id="btn-save"
                                    ng-click="adminSave(id)"
                                    ng-disabled="frmEmployees.$invalid">Create Account
                            </button>
                        </div>

                    </div>

                </div>
                <div class="col-sm-1"></div>

            </div>

        </div>
    </div>

@endsection