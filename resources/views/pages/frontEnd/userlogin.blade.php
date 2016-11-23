{{--
--
-- Author - Sahan Munasinghe <munasinghets93@gmail.com>
-- Version - v1.0.0
--
-- This is the login page
--
--}}

@extends('pages.index')

@section('content')

    <div class="container-fluid" ng-controller="loginController">

        <div class="container">


            <!-- --------------------------------------------------------------------------------------------------------------- -->
            <div class="row m-t-20 well bg-opc-65">

                <div class="row m-t-20">

                    <div class="col-sm-3"></div>


                    <!-- --------------------------------------------------------------------------------------------------------------- -->
                    <div class="col-sm-6">
                        <div class="col-sm-12 text-center m-t-20">
                            <h4>Log in to Tweet-U</h4>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12">

                            <!-- -------------------------------- FORM START ------------------------------------------------------------- -->
                            <form name="frmEmployees" class="form-horizontal" novalidate="">


                                <!-- -------------------------------- EMAIL ------------------------------------------------------------- -->
                                <div class="form-group">
                                    {{--<label for="inputEmail3" class="col-sm-3 control-label">Email</label>--}}

                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email Address"
                                               ng-model="email" ng-required="true">
                                        <span class="help-inline c-red"
                                              ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                    </div>
                                </div>

                                <!-- -------------------------------- PASSWORD ------------------------------------------------------------- -->
                                <div class="form-group">
                                    {{--<label for="inputEmail3" class="col-sm-3 control-label">Password</label>--}}

                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Password"
                                               ng-model="password" ng-required="true">
                                    <span class="help-inline c-red"
                                          ng-show="frmEmployees.password.$invalid && frmEmployees.password.$touched">Password field is required</span>
                                    </div>
                                </div>

                            </form>
                            <!-- -------------------------------- FORM END ------------------------------------------------------------- -->


                        </div>
                        <div class="col-sm-12 text-center">
                            {{--<div class="col-sm-3"></div>--}}
                            <div class="col-sm-12 p-0">
                                <button type="button" class="btn btn-twitter-custom btn-full-width" id="btn-save"
                                        ng-click="checkCredentials()"
                                        ng-disabled="frmEmployees.$invalid">Log in
                                </button>
                            </div>
                            {{--<div class="col-sm-3"></div>--}}
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>


                        <div class="col-sm-12 text-right">

                            <div class="col-sm-12 text-center">
                                Don't have an account?
                            </div>

                            <div class="col-sm-12 text-center">
                                <a href="register_user">Create Account</a>
                            </div>

                        </div>

                    </div>

                    <div class="col-sm-3"></div>

                </div>
            </div>
        </div>
    </div>

@endsection