<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KPI Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <!-- The bootstrap 5 tutorial is available here: https://www.w3schools.com/bootstrap5/index.php 
    and here:https://getbootstrap.com/docs/5.0/getting-started/introduction/ -->
    <!-- The Chart JS manual is available here: https://www.chartjs.org/docs/latest/charts/area.html -->
    <div class="row">
      <div class="col-md-2 bg-light bg-gradient">
        <h1>Business-Facing Analytics Dashboard</h1>
        <div style="color:#354E9D">
          <strong>BBT4106 and BBT4206: Business Intelligence Project (and BI1 Take-Away CAT 2)<br /></strong>
          <strong><br />Name: ACERS<br /></strong>
          <strong>Student ID: ACERS-GROUP<br /></strong>
        </div>
        <br />
        <strong>Kaplan and Norton’s Balanced Scorecard</strong>
          <ul>
            <li><strong>Financial Perspective (KPI1a and KPI1b)</strong>
              <ul>
              <li>KPI1a (leading): Forecasted Sales Growth Rate for the Year</li>
              <li>KPI1b (lagging): Increased profit Margin Percentage for the Year</li>
              </ul>
            </li>
            <li><strong>Customer Perspective (KPI2a and KPI2b)</strong>
            <ul>
              <li>KPI2a (leading):Number of Complaints Received and Resolved during the Year </li>
              <li>KPI2b (lagging): Customer Satisfaction Index for the Year</li>
              </ul>
            </li>
            <li><strong>Internal Business Processes Perspective (KPI3a and KPI3b)</strong>
            <ul>
              <li>KPI3a (leading): Average Time for Tea Leaves Processing</li>
              <li>KPI3b (lagging): Incresed Quality of the processed tea leaves</li>
              </ul>
            </li>
            <li><strong>Innovation and Learning Perspective (KPI4a and KPI4b)</strong>
            <ul>
              <li>KPI4a (leading): Employee Training Hours per Year</li>
              <li>KPI4b (lagging):  Improved farm productivity</li>
              </ul>
            </li>
          </ul>
      </div>
      <div class="col-md-10 row">
        
  <!-- Start of Key Metrics -->
  <?php
  function humanize_number($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'K';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'M';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'B';
        } else {
            return;
        }
    } else {
        return $input;
    }
  }

  function humanize_time($hours) {
  return $hours . ' hours';
}


  ?>
  <?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
 //////////// HIGHEST PROFIT MARGIN
  $sql = "SELECT MAX(year_2023_profit) AS highestProfit FROM profit_trends;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $highestProfit = $row['highestProfit'];
    }
  } else {
    echo "0 results";
  }
  ///////////////// TOTAL RESOLVED COMPLAINTS
  $sql = "SELECT SUM(complaint_resolved) AS complaintResolved FROM complaints;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $complaintResolved = $row['complaintResolved'];
    }
  } else {
    echo "0 results";
  }
  ////////////////////// TOTAL TIME FOR PROCESSING 
  $sql = "SELECT MAX(time_column) AS totalProcessingTime FROM processing;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $totalProcessingTime = $row['totalProcessingTime'];
    }
  } else {
    echo "0 results";
  }
  ///////////////////////// TOTAL TRAINED HOURS
  $sql = "SELECT SUM(training_hours) AS trainingHours FROM employeetraining;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $trainingHours = $row['trainingHours'];
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Highest Profit Margin</strong><hr>
              <h1>
                KES <?= humanize_number($highestProfit) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total resolved Complaints</strong><hr>
              <h1>
                <?= humanize_number($complaintResolved) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total Processing Time for Tea</strong><hr>
              <h1>
                <?= humanize_time($totalProcessingTime) ?>
              </h1>
            </div>
        </div>
  </div>
  <div class="col-md-3 my-1">
        <div class="card">
            <div class="card-body text-center">
              <strong>Total Time for Traning Employees</strong><hr>
              <h1>
                <?= humanize_time($trainingHours) ?>
              </h1>
            </div>
        </div>
  </div>
  <!-- End of Key Metrics -->

    <!-- Start of KPI DIVs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php include 'kpi1-draft.php'; ?> 
    <?php include 'kpi2.php'; ?>
    <?php include 'kpi3.php'; ?>
    <?php include 'kpi4.php'; ?>
    <!-- End of KPI DIVs -->
  </body>
</html>