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
    <title>Doctor Slips</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http, $filter) {
            $scope.colName = "dovisit";
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

                $http.get("history-doctorslips-fetchall-bydate.php?patientid=" + $scope.patientid + "&dateFrom=" + dateFrom + "&dateTo=" + dateTo).then(onSuccess, onError);

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
        }); //this comma is important
        
    </script>
    <style>
        th:hover {
            color: whitesmoke;
            cursor: pointer;
        }

    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller">
    <center>
        <h1 class="text-white" style="background-color:black">SLIP RECORDS</h1>
        <!--        fetch all record button-->
        <form>
            <div class="form-group form-row justify-content-center">
                <label for="" class="col-form-label mt-4">Username : </label>
                <div class="col-md-2 mt-4">
                    <input type="text" class="form-control" ng-model="patientid" ng-init="patientid='<?php echo $_SESSION["activeuser"]; ?>'" readonly>
                </div>
            </div>
        </form>
        <!--       search field-->
        <form>
            <div class="form-group form-row justify-content-center">

                <label for="" class="col-form-label mt-4">(Date of Visit) From : </label>
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

        <div class="container col-md-12">
            <table class="table" rules="cols">
                <thead bgcolor="steelblue">
                    <tr>
                        <td scope="col"><b>S.no.</b></td>
                        <th scope="col" ng-click="doSort('doctorname')">Doctor's Name</th>
                        <th scope="col" ng-click="doSort('dovisit')">Date of Visit</th>
                        <!--
                        <th scope="col" ng-click="doSort('city')">City</th>
                        <th scope="col" ng-click="doSort('hospital')">Hospital</th>
-->
                        <th scope="col" ng-click="doSort('problem')">Problem</th>
                        <th scope="col" ng-click="doSort('nextdov')">Next Date of Visit</th>
                        <th scope="col" ng-click="doSort('discussion')">Discussion</th>
<!--                        <th scope="col">Operations</th>-->
                        <td scope="col"><b>Pic</b></td>
                    </tr>
                </thead>
                <tbody>
                    <!--colName:true -> here true means reverse or not. So ultimately data is sorted in beginning  with '-colName'-->
                    <tr ng-repeat="obj in jsonArray | orderBy: colName: true">
                        <td scope="row">{{$index+1}}</td>
                        <td>{{obj.doctorname}}</td>
                        <td>{{obj.dovisit | date: "dd-MM-yyyy"}}</td>
                        <!--
                        <td>{{obj.city}}</td>
                        <td>{{obj.hospital}}</td>
-->
                        <td>{{obj.problem}}</td>
                        <td>{{obj.nextdov | date: "dd-MM-yyyy"}}</td>
                        <td>{{obj.discussion}}</td>
<!--
                        <td align="center">
                            <input type="button" class="btn btn-primary" value="Show" ng-click="showImage()">
                            <input type="button" class="btn btn-danger" value="Hide" ng-click="hideImage()">
                        </td>
-->
                        <td>
                            <img src="uploads/{{obj.slippic}}" height="400" width="300" alt="">
                        </td>
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

If say there is none(both start and end date....whole table is fetched corresponding to patientid)
-->
