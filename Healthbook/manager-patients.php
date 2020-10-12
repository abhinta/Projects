<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Manager</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.doSort = function(category) {
                $scope.colName = category;
            }
            $scope.doFetchAll = function() {
                $http.get("manager-patients-fetchall.php").then(onSuccess, onError);

                function onSuccess(response) {
                    $scope.jsonArray = response.data;
                }

                function onError(response) {
                    alert(JSON.stringify(response.data));
                }
            }
            $scope.doDelete = function(uid) {
                $http.get("manager-patients-delete.php?uid=" + uid).then(onSuccess, onError);

                function onSuccess(response) {
                    alert(response.data);
                    $scope.doFetchAll();
                }

                function onError(response) {
                    alert(response.data);
                }
            }
            $scope.doDetails = function(index) { //no requirement of query
                alert(
                    "Uid: " + $scope.jsonArray[index - 1].uid + "\n" +
                    "Contact: " + $scope.jsonArray[index - 1].contact + "\n" +
                    "Name: " + $scope.jsonArray[index - 1].name + "\n" +
                    "Age: " + $scope.jsonArray[index - 1].age + "\n" +
                    "Gender: " + $scope.jsonArray[index - 1].gender + "\n" +
                    "City: " + $scope.jsonArray[index - 1].city + "\n" +
                    "Email: " + $scope.jsonArray[index - 1].email + "\n" +
                    "Address: " + $scope.jsonArray[index - 1].address + "\n" +
                    "Problems: " + $scope.jsonArray[index - 1].problems);
            }
        }); //important is this this comma

    </script>
    <style>
        th:hover {
            background-color: darksalmon;
            cursor: pointer;
        }

    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <center>
        <h1>All Patient Profiles</h1>
        <!--        fetch all record button-->
        <form>
            <div class="form-row justify-content-center mt-4">
                <input type="button" ng-click="doFetchAll();" class="btn btn-success text-white" value="Fetch All Records">
            </div>
        </form>
        <!--       search field-->
        <form>
            <div class="form-group form-row justify-content-center mt-4">

                <label for="" class="col-md-2 col-form-label">Search From Records(by uid) : </label>
                <div class="col-md-3">
                    <input type="text" ng-model="googler.uid" class="form-control">
                </div>
            </div>
        </form>
        <!--        table-->
        <div class="container col-md-11">
            <table class="table">
                <thead bgcolor="floralwhite">
                    <tr>
                        <th scope="col">S.no.</th>
                        <th scope="col" ng-click="doSort('uid')">UID</th>
                        <th scope="col" ng-click="doSort('name')">Name</th>
                        <th scope="col" ng-click="doSort('contact')">Contact No.</th>
                        <th scope="col" ng-click="doSort('age')">Age</th>
                        <th scope="col" ng-click="doSort('problems')">Problems</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="obj in jsonArray | orderBy: colName | filter: googler">
                        <td scope="row">{{$index+1}}</td>
                        <td>{{obj.uid}}</td>
                        <td>{{obj.name}}</td>
                        <td>{{obj.contact}}</td>
                        <td>{{obj.age}}</td>
                        <td>{{obj.problems}}</td>
                        <td>
                            <div class="btn btn-danger" ng-click="doDelete(obj.uid)">Delete</div>
                            <div class="btn btn-primary" ng-click="doDetails($index + 1)">Details</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </center>
</body>

</html>
