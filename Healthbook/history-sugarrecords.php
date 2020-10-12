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
    <title>Sugar History</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http, $filter) {
            $scope.colName = "dateofrecord";
            $scope.jsonArray;
            $scope.doSort = function(category) {
                //toggle(general case)
                if ($scope.colName[0] == "-")
                    $scope.colName = category;
                else
                    $scope.colName = "-" + category;
            }
            $scope.doFetchByDate = function() {

                var dateFrom = $filter('date')($scope.dateFrom, "yyyy-MM-dd");
                var dateTo = $filter('date')($scope.dateTo, "yyyy-MM-dd");

                $http.get("history-sugarrecords-fetchall-bydate.php?uid=" + $scope.uid + "&dateFrom=" + dateFrom + "&dateTo=" + dateTo).then(onSuccess, onError);

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
            $("#cmbType").change(function() {
                var type = $(this).val();

                if (type == "bloodsugar") {
                    $("#table-blood-sugar").css("display", "contents");
                    $("#table-urine-sugar").css("display", "none");
                    $("#table-both").css("display", "none");
                } else if (type == "urinesugar") {
                    $("#table-blood-sugar").css("display", "none");
                    $("#table-urine-sugar").css("display", "contents");
                    $("#table-both").css("display", "none");
                } else {
                    $("#table-blood-sugar").css("display", "none");
                    $("#table-urine-sugar").css("display", "none");
                    $("#table-both").css("display", "contents");
                }
            });

        }); //important is this this comma

    </script>
    <style>
        th:hover {
            /*            background-color: steelblue;*/
            /*            background-color: whitesmoke;*/
            color: whitesmoke;
            cursor: pointer;
        }

    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <center>
        <h1 class="text-primary" style="background-color:aliceblue">All Sugar Records</h1>
        <!--        fetch all record button-->
        <form>
            <div class="form-group form-row justify-content-center">
                <label for="" class="col-form-label mt-4">Username : </label>
                <div class="col-md-2 mt-4">
                    <input type="text" class="form-control" ng-model="uid" ng-init="uid='<?php echo $_SESSION["activeuser"]; ?>'" readonly>
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
                <div class="col-md-3 mt-4">
                    <select class="form-control" id="cmbType">
                        <option value="all" selected>All</option>
                        <option value="bloodsugar">Blood Sugar</option>
                        <option value="urinesugar">Urine Sugar</option>
                    </select>
                </div>
                <div class="col-md-1 mt-4">
                    <input type="button" class="btn btn-outline-success" value="Search" ng-click="doFetchByDate();">
                </div>
            </div>
        </form>

        <div class="container col-md-11">
            <!--        table, all records-->
            <table class="table" id="table-both">
                <thead bgcolor="steelblue">
                    <tr>
                        <th scope="col">S.no.</th>
                        <!--                        <th scope="col" ng-click="doSort('uid')">UID</th>-->
                        <th scope="col" ng-click="doSort('dateofrecord')">Date</th>
                        <th scope="col" ng-click="doSort('timerecord')">Time</th>
                        <th scope="col" ng-click="doSort('sugartime')" id="sug-time">Sugar Time Phase</th>
                        <th scope="col" ng-click="doSort('sugarresult')" id="sug-res">Result Blood Sugar(mg/dl)</th>
                        <th scope="col" ng-click="doSort('medintake')" id="uri-med">Doctor's Advice(Urine Sugar)</th>
                        <th scope="col" ng-click="doSort('urineresult')" id="uri-res">Result Urine Sugar(mmol/L)</th>
                    </tr>
                </thead>
                <tbody>
                    <!--colName:true -> here true means reverse or not. So ultimately data is sorted in beginning  with '-colName'-->
                    <tr ng-repeat="obj in jsonArray | orderBy: colName: true">
                        <td scope="row">{{$index+1}}</td>
                        <!--                        <td>{{obj.uid}}</td>-->
                        <td>{{obj.dateofrecord | date: "dd-MM-yyyy"}}</td>
                        <td>{{obj.timerecord}}</td>
                        <td>{{obj.sugartime}}</td>
                        <td>{{obj.sugarresult}}</td>
                        <td>{{obj.medintake}}</td>
                        <td>{{obj.urineresult}}</td>
                    </tr>
                </tbody>
            </table>
            <!--        table blood sugar records-->
            <table class="table" id="table-blood-sugar" style="display:none;">
                <thead bgcolor="steelblue">
                    <tr>
                        <th scope="col">S.no.</th>
                        <!--                        <th scope="col" ng-click="doSort('uid')">UID</th>-->
                        <th scope="col" ng-click="doSort('dateofrecord')">Date</th>
                        <th scope="col" ng-click="doSort('timerecord')">Time</th>
                        <th scope="col" ng-click="doSort('sugartime')" id="sug-time">Sugar Time Phase</th>
                        <th scope="col" ng-click="doSort('sugarresult')" id="sug-res">Result Blood Sugar(mg/dl)</th>
                    </tr>
                </thead>
                <tbody>
                    <!--colName:true -> here true means reverse or not. So ultimately data is sorted in beginning  with '-colName'-->
                    <tr ng-repeat="obj in jsonArray | orderBy: colName: true">
                        <td scope="row">{{$index+1}}</td>
                        <!--                        <td>{{obj.uid}}</td>-->
                        <td>{{obj.dateofrecord | date: "dd-MM-yyyy"}}</td>
                        <td>{{obj.timerecord}}</td>
                        <td>{{obj.sugartime}}</td>
                        <td>{{obj.sugarresult}}</td>
                    </tr>
                </tbody>
            </table>
            <!--        table urine sugar records-->
            <table class="table" id="table-urine-sugar" style="display:none;">
                <thead bgcolor="steelblue">
                    <tr>
                        <th scope="col">S.no.</th>
                        <!--                        <th scope="col" ng-click="doSort('uid')">UID</th>-->
                        <th scope="col" ng-click="doSort('dateofrecord')">Date</th>
                        <th scope="col" ng-click="doSort('timerecord')">Time</th>
                        <th scope="col" ng-click="doSort('medintake')" id="uri-med">Doctor's Advice(Urine Sugar)</th>
                        <th scope="col" ng-click="doSort('urineresult')" id="uri-res">Result Urine Sugar(mmol/L)</th>
                    </tr>
                </thead>
                <tbody>
                    <!--colName:true -> here true means reverse or not. So ultimately data is sorted in beginning  with '-colName'-->
                    <tr ng-repeat="obj in jsonArray | orderBy: colName: true">
                        <td scope="row">{{$index+1}}</td>
                        <!--                        <td>{{obj.uid}}</td>-->
                        <td>{{obj.dateofrecord | date: "dd-MM-yyyy"}}</td>
                        <td>{{obj.timerecord}}</td>
                        <td>{{obj.medintake}}</td>
                        <td>{{obj.urineresult}}</td>
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
