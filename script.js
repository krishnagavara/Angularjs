var app = angular.module('myApp',[]);
app.controller('studentController',function($scope)
{
   $scope.student = {
   	 firstName : "krishna",
   	 lastName : "Gavara",
   	 fees : 500,
 
   subjects:[
                  {name:'Physics',marks:70},
                  {name:'Chemistry',marks:80},
                  {name:'Math',marks:65}
               ],
   fullName: function()
   {
   	 var studentObject;
   	 studentObject = $scope.student;
   	 return studentObject.firstName + " " + studentObject.lastName;
   }
 };
});