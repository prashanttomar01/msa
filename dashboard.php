<?php
session_start();
require_once "includes/common_functions.php";
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$query = "SELECT status SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END), SUM(CASE WHEN status = 'inactive' THEN 1 ELSE 0 END) FROM users";
$users = $obj->select($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <div class="main-page">
        <div class="content mt-3">
            <h2>M S A</h2>
            <p>Here is the main content of the dashboard.</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="content1 mt-3">
                    <div id="piechart_3d" class="piechart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="content2 mt-3">
                    <div id="piechart_3d_2" class="piechart"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);

            var options = {
                title: 'My Daily Activities',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);

            var options = {
                title: 'My Daily Activities',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
            chart.draw(data, options);
        }
    </script>
    <?php // include 'includes/footer.php'; 
    ?>
</body>

</html>