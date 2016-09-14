<!DOCTYPE html>
<html>
<head>
	<title>Gettimng response from database</title>
	<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>
      <script type="text/javascript" src="scripts/webservice.js"></script>
      <link rel="stylesheet" type="text/css" href="style/styles.css">
</head>
<body>
	<div ng-app='myApp' ng-controller='myController'>
	Search : <input type="text" name="search" ng-model="searchText">
		<table>
			<thead>
				<tr>
					<th ng-click="sortlist('name')">
					   	 Name <div ng-class="getSortClass('name')"></div>
 					 </th>
					<th ng-click="sortlist('email')">
					   	 Email <div ng-class="getSortClass('email')"></div>
 					 </th>
					<th ng-click="sortlist('phone')">
					   	 Phone <div ng-class="getSortClass('phone')"></div>
 					 </th>
					<th ng-click="sortlist('address')">
					   	 Address <div ng-class="getSortClass('address')"></div>
 					 </th>
					<th ng-click="sortlist('foreigner')">
					   	 Foreigner <div ng-class="getSortClass('foreigner')"></div>
 					 </th>
					<th ng-click="sortlist('passport_no')">
					   	 Passport <div ng-class="getSortClass('passport_no')"></div>
 					 </th>
					<!-- <th>Customer Proof1</th>
					<th>Customer Proof2</th>
					<th>Front ViewImage</th>
					<th>Back ViewImage</th> -->
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="customer in customers | filter : searchText | orderBy:sortColumn:reverseSort">
			    <td>{{ customer.name }}</td>
			    <td>{{ customer.email }}</td>
			    <td>{{ customer.phone }}</td>
			    <td>{{ customer.address }}</td>
			    <td>{{ customer.foreigner }}</td>
			    <td>{{ customer.passport_no }}</td>
			  </tr>
			</tbody>		  
		</table>
	</div>
</body>
</html>