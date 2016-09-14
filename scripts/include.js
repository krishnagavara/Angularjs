var app = angular.module('myApp',[]);
app.controller('myController',function($scope)
{
	var employees =
	[
		{name:"krishna",gender:'male',salary:30000},
		{name:"sai",gender:'male',salary:50000},
		{name:"atousa",gender:'female',salary:10000},
		{name:"priyanka",gender:'female',salary:10000},
		{name:"raj",gender:'male',salary:50000},
		{name:"punna",gender:'male',salary:40000},
	];
	$scope.employees = employees;
	$scope.include = "include.html";
});