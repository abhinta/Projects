<!--
data is sorted on the basis of date
Also, it toggles
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor search</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        var module = angular.module("mymodule", []);
        module.controller("mycontroller", function($scope, $http, $filter) {
            $scope.jsonArray;

            $scope.doFetchCities = function() {
                $http.get("doctor-search-fetch-cities.php").then(onSuccess, onError);

                function onSuccess(response) {
                    $scope.jsonArrayCity = response.data;

                    //in order to avoid blank row
                    $scope.selObjectCity = $scope.jsonArrayCity[0];

                    if (response.data.length == 0) //never in our case, because my table will never be empty
                        alert("No city exist");
                }

                function onError(response) {
                    alert(JSON.stringify(response.data));
                }
            }
            $scope.doFindDoctor = function() {
                $http.get("doctor-search-fetch-doctors.php?city=" + $scope.selObjectCity.city).then(onSuccess, onError);

                function onSuccess(response) {
                    $scope.jsonArray = response.data;

                    if (response.data.length == 0) //never in our case, because doctors table will always have a doctor for that city
                        alert("No doctor exist");
                }

                function onError(response) {
                    alert(JSON.stringify(response.data));
                }
            }
        }); //important is this comma

    </script>
    <style type="text/css">
        
        img:hover + .card-body{
            display: none;
        }
        img:hover{
            height:350px !important;
            transition:ease all 1s;
        }
        img{
            transition:ease all 0.5s;
        }
        
    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller" ng-init="doFetchCities();">
    <center>
        <h1 class="bg-success">Doctor Search</h1>
        <!--        fetch City records-->
        <form>
            <div class="form-group form-row justify-content-center align-items-center">
                <label for="" class="col-form-label mt-4 mr-3">Select City:</label>
                <div class="col-md-2 mt-4">
                    <select class="form-control" ng-options="obj.city for obj in jsonArrayCity" ng-model="selObjectCity"></select>
                </div>
                <div class="col-md-2 mt-4">
                    <input type="button" ng-click="doFindDoctor();" class="btn btn-outline-danger" value="Find Doctor">
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-3 mt-3 mr-3 ml-3" ng-repeat="obj in jsonArray | orderBy:colName">
                <div class="card" style="float:left;max-width:350px;">
                    <img src="uploads/{{obj.ppic}}" style="height:120px;width:300px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{obj.dname}}</h5>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Qualification
                                    </th>
                                    <td style="width:90%">
                                        {{obj.qual}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Speciality
                                    </th>
                                    <td style="width:90%">
                                        {{obj.spl}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Hospital
                                    </th>
                                    <td style="width:90%">
                                        {{obj.hospital}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Address
                                    </th>
                                    <td style="width:90%">
                                        {{obj.address}}, {{obj.pincode}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Experience
                                    </th>
                                    <td style="width:90%">
                                        {{obj.exp}} yr
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width:10%">
                                        Contact No.
                                    </th>
                                    <td style="width:90%">
                                        {{obj.mobile}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>

</html>