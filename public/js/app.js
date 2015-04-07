'use strict';
var app = angular.module('linkDashboard', []);

var apiURL = '/index.php/api/';

app.service('loginService', function() {
    this.username = 0;
});

app.service('linkService', ['$http', function($http) {
    var linkService = this;
    linkService.order = '-votes.length';
    linkService.active = null;

    $http.get(apiURL + 'links').
        success(function(data) {
            linkService.all = data;
            linkService.active = linkService.all[0];
        }).
        error(function(){
            console.log('Could not get links');
        });
}]);

app.controller('LoginController', ['$scope', 'loginService', function($scope, loginService){
    var login = this;

    login.getUsername = function(){
        return loginService.username;
    };

    login.loginUser = function() {
        loginService.username = $scope.loginUsername;
        $scope.loginUsername = '';
        $scope.loginPassword = '';
    };

    login.logoutUser = function() {
        loginService.username = 0;
    }
}]);


app.controller('LinksController', ['$scope', '$http', 'linkService', function($scope, $http, linkService){
    var linkList = this;

    linkList.getOrder = function() {
        return linkService.order;
    };

    linkList.setOrder = function(order) {
        linkService.order = order;
    };

    linkList.currentOrder = function(order) {
        if ( order == linkService.order) {
            return true;
        }
    }

    linkList.getAll = function() {
      return linkService.all;
    };

    linkList.addLink = function() {
        var linkData = {title: $scope.newLinkTitle, url:$scope.newLinkURL, user_id: 1};
        $http.post(apiURL + 'link', linkData).
            success(function(data){
                $scope.newLinkTitle = '';
                $scope.newLinkURL = '';
                angular.copy(data, linkService.all);
                linkService.setOrder('-created_on');
            }).
            error(function(){
                console.log('Error saving link.');
            });
    };

    linkList.setActive = function(id) {
        linkService.active = linkService.all[linkList.searchArray(id)];
    };

    linkList.getActive = function() {
      return linkService.active;
    };

    linkList.searchArray = function(id) {
        var i = 0;
        for (i; i<linkService.all.length; i++){
            if (linkService.all[i].id == id) {
                return i;
            }
        }
        return null;
    };

    linkList.upvote = function(id) {
        $http.post(apiURL + 'link/vote/' + id).
            success(function(data) {
                linkService.all[linkList.searchArray(id)].votes.push({id:0});
                var button = $("#upvote-" + id);
                button.attr('disabled', 'disabled');
                button.find('img').attr('src', '/img/up-arrow-white.png');
            }).
            error(function(){
                console.log('Could not get links');
            });
    }
}]);

app.controller('UsersController', ['$http', function($http) {
    var users = this;

    users.lookup = function(id) {
        // Build this out
    };

}]);

app.directive("navigation", function(){
   return {
       restrict: 'E',
       templateUrl : "/includes/navigation-header.html"
   }
});

app.directive("linkListing", function(){
    return {
        restrict: 'E',
        templateUrl : "/includes/link-listing.html"
    }
});

app.directive("addLink", function(){
    return {
        restrict: 'E',
        templateUrl : "/includes/add-link.html"
    }
});