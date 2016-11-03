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
                <h1 class="page-header">Add Testing Search Logs</h1>


                <input class="form-control" ng-model="TweetAnalysis">
                <a href="" ng-click="saveTweetAnaylysisLog('1', TweetAnalysis)" class="btn btn-default btn-full-width">Add Tweet Analysis</a>

                <hr>

                <input class="form-control" ng-model="UserAnalysis">
                <a href="" ng-click="saveTweetAnaylysisLog('2', UserAnalysis)" class="btn btn-default btn-full-width">Add User Account Analysis</a>

                <hr>

                <input class="form-control" ng-model="ComparisonAnalysis">
                <a href="" ng-click="saveTweetAnaylysisLog('3', ComparisonAnalysis)" class="btn btn-default btn-full-width">Add Topic Comparisons</a>

            </div>
            <!-- /.col-lg-12 -->
        </div>


    </div>
@endsection