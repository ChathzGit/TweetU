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
    <div id="page-wrapper" ng-controller="userAccountController">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User accounts</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="border" ng-repeat="user in users">
                    <% user.name %>
                </div>
            </div>
        </div>



    </div>
@endsection