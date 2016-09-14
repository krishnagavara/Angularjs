var app = angular.module('myApp',[]);
app.controller('myController',function($scope, $http) {
   $http.get("getresponse.php")
   .then(function (response) 
   	{
   		$scope.customers = response.data;
   		$scope.sortColumn = 'name';
		$scope.reverseSort = false;
		$scope.sortlist = function(employee)
		{
			$scope.reverseSort  = ($scope.sortColumn == employee) ?  !$scope.reverseSort : false;
			$scope.sortColumn = employee;
		}
		$scope.getSortClass = function(employee)
		{
			if($scope.sortColumn == employee)
			{
				return $scope.reverseSort ? 'arrow-down' : 'arrow-up'	
			}
			return '';
		}
   	});
});