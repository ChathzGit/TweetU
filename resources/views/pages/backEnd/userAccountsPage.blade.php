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

                        <div class="col-sm-10">
                            <div class="col-sm-12">
                                <strong>User ID:</strong>
                                <% user.id %>
                            </div>

                            <div class="col-sm-12">
                                <strong>User name:</strong>
                                <% user.name %>
                            </div>

                            <div class="col-sm-12">
                                <strong>User email:</strong>
                                <% user.email %>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-danger" ng-click="deleteUser(user.id)">Delete User</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection