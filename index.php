<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="etc/css/bootstrap.min.css">
  <link rel="stylesheet" href="etc/css/general.css">
  <script src="etc/js/jquery.min.js"></script>
  <script src="etc/js/bootstrap.min.js"></script>
  <script src="etc/js/angular.min.js"></script>
</head>
<body ng-app="app" ng-controller="ctrl">
  <?php include_once ('include/nav.php');?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="https://placehold.it/1200x400?text=IMAGE" alt="Image">
        <div class="carousel-caption">
          <h3>Sell $</h3>
          <p>Money Money.</p>
        </div>
      </div>

      <div class="item">
        <img src="https://placehold.it/1200x400?text=Another Image Maybe" alt="Image">
        <div class="carousel-caption">
          <h3>More Sell $</h3>
          <p>Lorem ipsum...</p>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<div class="container text-center">
  <div class="container-fluid text-center">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div>
          <!--filter title-->
          <input type="text" ng-model="findtitel" placeholder="Search">
        </div>
        <div>
          Game Cattegory
          <div align="left" ng-repeat="tech in category">
            <label><input type="checkbox" ng-model="tech.on">{{tech.category}}</label>
          </div>
        </div>
        <br>
        <div>
          Avg. Rate
          <div align="left">
            <a href="#">4 Star &amp; Up</a><br>
            <a href="#">3 Star &amp; Up</a><br>
            <a href="#">2 Star &amp; Up</a><br>
            <a href="#">1 Star &amp; Up</a><br>
          </div>
        </div>
      </div>
      <div class="col-sm-9 text-left">
        <h1 align="center">Game List</h1>
        <hr>
        <div>
          order by: <select ng-model="selectedOrder" ng-options="option for option in options"></select>
          <div ng-repeat="x in games | filter:{title: findtitel} | customFilter:(category|filter:{on:true}) | orderBy:selectedOrder" class="row" >
            <div class="col-sm-4 text-left"><img class="img-rounded" src="etc/img/{{x.img}}" alt="{{x.img}}" title="{{x.img}}"></div>
            <div class="col-sm-4 text-center"><strong>{{x.title}}</strong></div>
            <div class="col-sm-2 text-center">{{x.category}}</div>
            <div class="col-sm-2 text-center"><a href="#" class="btn btn-primary btn-xs">Detail</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

<!-- login's Modal -->
<div id="id01" class="modal">
  <form class="modal-content animate" action="#">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container-fluid">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit">Login</button>
      <input type="checkbox" checked="checked"> Remember me
    </div>

    <div class="container-fluid" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <a href="signup.php"><button type="button" onclick="document.getElementById('id01').style.display='none'" class="signupbtn">Sign Up</button></a>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

<script>
// Get the modal.
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



angular.module('app', [])
.controller('ctrl', function($scope, $http) {
  $scope.options = ['title','rate'];
  $scope.category = [
    {category: "JRPG", on: false},
    {category: "Real Time", on: false},
    {category: "Simulator", on: false},
    {category: "Adventure", on: false},
    {category: "Turn Based Action", on: false},
    {category: "Single Player", on: false},
    {category: "Multi Player", on: false},
    {category: "Online", on: false},
    {category: "Offline", on: false},
    {category: "Strategy",on: false}];
    $http.get("http://localhost/onlinetest/include/getlistgame.php").then(function(response){
  $scope.games = response.data});
})
.filter('customFilter', function() {
  return function(input, titles) {
    if(!titles || titles.length === 0) return input;
    var out = [];
    angular.forEach(input, function(item) {
      angular.forEach(titles, function(tech) {
        if (item.category === tech.category) {
          out.push(item);
        }
      });
    });
    return out;
  }
});
</script>

</body>
</html>
