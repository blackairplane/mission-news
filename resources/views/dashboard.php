<!doctype html>
<html ng-app="linkDashboard">
	<head>
        <link rel="dns-prefetch" href="//www.chackernews.dev">
		<title>World Mission News</title>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href="http://chackernews.dev/css/foundation.min.css" rel="stylesheet" type="text/css">
		<link href="http://chackernews.dev/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="http://chackernews.dev/css/dashboard.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800' rel='stylesheet' type='text/css'>
        <script src="http://chackernews.dev/js/vendor/angular.min.js" type="text/javascript"></script>
        <script src="http://chackernews.dev/js/app.js" type="text/javascript"></script>
	</head>
	<body>
		<navigation></navigation>

        <div class="container large-10">
            <link-listing></link-listing>
            <add-link></add-link>
        </div>


        <div id="commentModal" class="reveal-modal" data-reveal aria-labelledby="commentModalTitle" aria-hidden="true" role="dialog" ng-controller="LinksController as linksCtrl">
            <h2 id="commentModalTitle"></h2>
            <p class="lead">{{linksCtrl.getActive().title}}</p>
            <ul ng-repeat="comment in linksCtrl.getActive().comments" class="list-unstyled">
                <li class="comment">
                    <hr />
                    <p>
                        {{comment.text}} — <a href="#" ng-controller="UsersController as usersCtrl">{{comment.user_id}}</a> on <span>{{comment.created_at | date}}</span>
                    </p>
                </li>
            </ul>
            <a href="#">Add a comment</a>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation('reveal');
            $(document).ready(function(){

            });
        </script>
	</body>
</html>
