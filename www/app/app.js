var especial = angular.module('especial', ['ngRoute']);

especial.config(function($routeProvider) {
    $routeProvider.when('/',
        {
            controller: 'custPage',
            templateUrl: 'app/partials/cust_form.tpl.html'
        });
});

especial.config(function($httpProvider) {
    $httpProvider.defaults.transformRequest = function(request){
        if(typeof(request)!='object'){
            return request;
        }
        var str = [];
        for(var k in request){
            if(k.charAt(0)=='$'){
                delete request[k];
                continue;
            }
            var v='object'==typeof(request[k])?JSON.stringify(request[k]):request[k];
            str.push(encodeURIComponent(k) + "=" + encodeURIComponent(v));
        }
        return str.join("&");
    };
    $httpProvider.defaults.timeout=10000;
    $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
    };
});
especial.controller('custPage', function($scope, $http){
    $scope.cust = {};
    $scope.custCreUpd = function(){
        $http({
            method: 'POST',
            url: 'app/php/cust_cre_upd.php',
            data: $scope.cust,
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data){
            console.log(data)
        }).error(function(err){
            console.log(err)
        })
    };
});