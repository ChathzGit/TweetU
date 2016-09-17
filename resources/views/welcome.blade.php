<!Doctype html>
<html ng-app="myApp">
	<head>
		<title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/angular.min.js') }}"></script>
        <script src="{{ asset('/js/twitter-sentiment.js') }}"></script>
	</head>
	<body>
		<div>
			<div class="content">
				<div class="quote" ng-controller="ctrlPosNeg">
                    <label><b>Percentages</b></label>
                    <label id="positive"><%positive%></label>
                    <br>
                    <label id="negative"><%negative%></label>
                </div>
                <br>
                <br>
                <div class="quote" ng-controller="topPosNeg">
                    <label><b>Positive Top</b></label>
                    <div ng-repeat="items in positives">
                        <label><%items["text"]%></label>
                        <br>
                    </div>
                    <br>
                    <label><b>Negative Top</b></label>
                    <div ng-repeat="items in negatives">
                        <label><%items["text"]%></label>
                        <br>
                    </div>
                </div>
			</div>
		</div>
	</body>
</html>
