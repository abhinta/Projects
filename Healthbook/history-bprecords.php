<?php
session_start();
?>
<!--
data is sorted on the basis of date
Also, it toggles
session waali line must be line 1 of the file
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BP History</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http, $filter) {
            $scope.colName = "dateofrecord";
            $scope.jsonArray;
            //$scope.uid;
            $scope.doSort = function(category) {
                //toggle(general case)
                if ($scope.colName[0] == "-")
                    $scope.colName = category;
                else
                    $scope.colName = "-" + category;
            }

            $scope.doFetchAll = function(uid) {
                $http.get("history-bprecords-fetchall.php?uid=" + uid).then(onSuccess, onError);

                function onSuccess(response) {
                    $scope.jsonArray = response.data;

                    if (response.data.length == 0)
                        alert("No BP records exist")
                }

                function onError(response) {
                    alert(JSON.stringify(response.data));
                }
            }
            $scope.doFetchByDate = function() {
                
//                var dateStr=$scope.dateFrom.toString();//Sat Jul 11 2020 00:00:00 GMT+0530 (India Standard Time)
//                var tempyr=$filter('date')($scope.dateFrom, "yyyy");
//                var tempdate=$filter('date')($scope.dateFrom, "dd");
//                var tempmon=$filter('date')($scope.dateFrom, "MM");
                var dateFrom=$filter('date')($scope.dateFrom,"yyyy-MM-dd");
                var dateTo=$filter('date')($scope.dateTo,"yyyy-MM-dd");
                
                $http.get("history-bprecords-fetchall-bydate.php?uid=" + $scope.uid + "&dateFrom=" + dateFrom + "&dateTo=" + dateTo).then(onSuccess, onError);

                function onSuccess(response) {
                    $scope.jsonArray = response.data;
//                    alert(JSON.stringify(response.data));
                    if (response.data.length == 0)
                        alert("No records exist within this range of dates")
                }

                function onError(response) {
                    alert(JSON.stringify(response.data));
                }
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
        <h1 class="bg-dark text-white-50">All BP Records</h1>
        <!--        fetch all record button-->
        <form>
            <div class="form-group form-row justify-content-center">
                <label for="" class="col-form-label mt-4">Username : </label>
                <div class="col-md-2 mt-4">
                    <input type="text" class="form-control" ng-model="uid" 
                    ng-init="uid='<?php echo $_SESSION["activeuser"];?>'" readonly>
                </div>
                <div class="col-md-2 mt-4">
                    <input type="button" ng-click="doFetchAll(uid);" class="btn btn-warning text-white" value="Fetch Records">
                </div>

            </div>
        </form>
        <!--       search field-->
        <form>
            <div class="form-group form-row justify-content-center">

                <label for="" class="col-form-label mt-4">Search From : </label>
                <div class="col-md-3 mr-3 mt-4">
                    <input type="date" ng-model="dateFrom" class="form-control">
                </div>
                <label for="" class="col-form-label mt-4">To : </label>
                <div class="col-md-3 mt-4">
                    <input type="date" ng-model="dateTo" class="form-control">
                </div>
                <div class="col-md-1 mt-4">
                    <input type="button" class="btn btn-outline-success" value="Search" ng-click="doFetchByDate();">
                </div>


            </div>
        </form>
        <!--        table-->
        <div class="container col-md-11">
            <table class="table">
                <thead bgcolor="floralwhite">
                    <tr>
                        <th scope="col">S.no.</th>
<!--                        <th scope="col" ng-click="doSort('uid')">UID</th>-->
                        <th scope="col" ng-click="doSort('pulse')">Pulse (in min)</th>
                        <th scope="col" ng-click="doSort('dateofrecord')">Date of Record</th>
                        <th scope="col" ng-click="doSort('syst')">Systolic Pressure (mm/Hg)</th>
                        <th scope="col" ng-click="doSort('dia')">Diastolic Pressure (mm/Hg)</th>
                    </tr>
                </thead>
                <tbody>
                    <!--colName:true -> here true means reverse or not. So ultimately data is sorted in beginning  with '-colName'-->
                    <tr ng-repeat="obj in jsonArray | orderBy: colName: true">
                        <td scope="row">{{$index+1}}</td>
                        <td>{{obj.pulse}}</td>
                        <td>{{obj.dateofrecord | date:"dd-MM-yyyy"}}</td>
                        <td>{{obj.syst}}</td>
                        <td>{{obj.dia}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </center>
</body>

</html>
<!--
Readme
Once user inputs date, its difficult for him to nullify it
So, in order to get back his whole record as it is(before segregating through search button)...
                        "simply press fetch button to retrieve full data at any time"
                        
The search button technique is best, although same functionality(almost) can be achieved by ng-blur[problem would be when there exist both start date and end date...so intersection waale records won't get fetched]

Filling Only Start Date, doesn't work by default...hence, amendment in bydate.php
Only end Date filter works by default, since in that case start date would be 0000-00-00

If say there is none(both start and end date....whole table is fetched corresponding to uid)
-->
