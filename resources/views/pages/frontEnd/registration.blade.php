{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the registration page
--
--}}

@extends('pages.index')

@section('content')


    <div class="container" ng-controller="userAccountController">

        <div class="row m-t-20 well">

            <div class="col-sm-1"></div>


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="col-sm-10">
                <div class="col-sm-12 text-center m-t-20">
                    <h4>Create User Account</h4>
                </div>

                <div class="col-sm-12">
                    <hr>
                </div>

                <div class="col-sm-12">

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
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
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


                </div>
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary p-l-30 p-r-30" id="btn-save" ng-click="save(id)"
                            ng-disabled="frmEmployees.$invalid">Create Account
                    </button>
                </div>
            </div>

            <div class="col-sm-1"></div>

        </div>
    </div>

@endsection