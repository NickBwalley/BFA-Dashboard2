<!-- Data for KPI1a: Top 5 selling products of the year-->
<?php
  $currentYear_top5SellingProducts = 2023;
  $salesPerProduct_target = 1300;

  $currentYear_monthlySalesRevenue = 2023;
  $previousYear_monthlySalesRevenue = $currentYear_monthlySalesRevenue - 1;
  $monthlySalesRevenue_target = 300000;

?>
<?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "CALL `Top5SellingProductsofTheYear`($currentYear_top5SellingProducts);";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row_num = array();
    $productCode = array();
    $productName = array();
    $productLine = array();
    $fullProductDetails = array();
    $sumPriceEach = array();
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $row_num[$row['row_num']] = $row['row_num'];
      $productCode[$row['row_num']] = $row['productCode'];
      $productName[$row['row_num']] = $row['productName'];
      $productLine[$row['row_num']] = $row['productLine'];
      $sumPriceEach[$row['row_num']] = $row['sumPriceEach'];
      $fullProductDetails[$row['row_num']] = $row['fullProductDetails'];
    }
  } else {
    "0 results";
  }
  
  $conn->close();

  /* Getting the product details of the top 5 products */
  // echo "TESTING: The full product details of the best performing product  is '" . $fullProductDetails['1'] . "'<br>";

  $fullProductDetails1 = array();
  $fullProductDetails2 = array();
  $fullProductDetails3 = array();
  $fullProductDetails4 = array();
  $fullProductDetails5 = array();

  $fullProductDetails1 = !isset($fullProductDetails['1']) ? null : $fullProductDetails['1'];
  $fullProductDetails2 = !isset($fullProductDetails['2']) ? null : $fullProductDetails['2'];
  $fullProductDetails3 = !isset($fullProductDetails['3']) ? null : $fullProductDetails['3'];
  $fullProductDetails4 = !isset($fullProductDetails['4']) ? null : $fullProductDetails['4'];
  $fullProductDetails5 = !isset($fullProductDetails['5']) ? null : $fullProductDetails['5'];

  $currentYear_monthlySalesRevenueTop5SellingfullProductDetails = array($fullProductDetails1, $fullProductDetails2, 
                                                    $fullProductDetails3, $fullProductDetails4, 
                                                    $fullProductDetails5);
  $jsonCurrentYearTop5SellingfullProductDetails = json_encode($currentYear_monthlySalesRevenueTop5SellingfullProductDetails);
  // echo "TESTING: The JSON values are " . $jsonCurrentYearTop5SellingfullProductDetails;


  /* Getting the sales revenue earned by the top 5 products in the current year */
  
  // echo "TESTING: The total amount earned by the best performing product  is '" . $sumPriceEach['1'] . "'<br>";

  $sumPriceEach1 = array();
  $sumPriceEach2 = array();
  $sumPriceEach3 = array();
  $sumPriceEach4 = array();
  $sumPriceEach5 = array();

  $sumPriceEach1 = !isset($sumPriceEach['1']) ? null : $sumPriceEach['1'];
  $sumPriceEach2 = !isset($sumPriceEach['2']) ? null : $sumPriceEach['2'];
  $sumPriceEach3 = !isset($sumPriceEach['3']) ? null : $sumPriceEach['3'];
  $sumPriceEach4 = !isset($sumPriceEach['4']) ? null : $sumPriceEach['4'];
  $sumPriceEach5 = !isset($sumPriceEach['5']) ? null : $sumPriceEach['5'];

  $currentYearTop5SellingSumPriceEach = array($sumPriceEach1, $sumPriceEach2, 
                                                    $sumPriceEach3, $sumPriceEach4, 
                                                    $sumPriceEach5);
  $jsonCurrentYearTop5SellingSumPriceEach = json_encode($currentYearTop5SellingSumPriceEach);
  // echo "TESTING: The JSON values are " . $jsonCurrentYearTop5SellingSumPriceEach;
?>

<!-- Data for KPI 1b: Year-on-Year Monthly Sales Revenue-->
<?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "CALL `YOYSalesRevenuePerMonth`(2023);";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $current_january = array();
    $current_february = array();
    $current_march = array();
    $current_april = array();
    $current_may = array();
    $current_june = array();
    $current_july = array();
    $current_august = array();
    $current_september = array();
    $current_october = array();
    $current_november = array();
    $current_december = array();
    $salesRevenue = array();
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $salesRevenue[$row['paymentYear']][$row['paymentMonth']] = $row['salesRevenue'];
    }
  } else {
    echo "0 results";
  }
  
  $conn->close();

  // echo "TESTING: The value for $currentYear_monthlySalesRevenue February is " . $salesRevenue[$currentYear_monthlySalesRevenue]['February'] . "<br>";
  
  /* Monthly sales revenue for the current year (for a year-on-year comparison) */
  /* January */
  $current_january = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['January']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['January'];
  /* February */
  $current_february = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['February']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['February'];
  /* March */
  $current_march = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['March']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['March'];
  /* April */
  $current_april = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['April']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['April'];
  /* May */
  $current_may = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['May']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['May'];
  /* June */
  $current_june = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['June']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['June'];
  /* July */
  $current_july = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['July']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['July'];
  /* August */
  $current_august = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['August']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['August'];
  /* September */
  $current_september = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['September']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['September'];
  /* October */
  $current_october = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['October']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['October'];
  /* November */
  $current_november = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['November']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['November'];
  /* December */
  $current_december = !isset($salesRevenue[$currentYear_monthlySalesRevenue]['December']) ? null : $salesRevenue[$currentYear_monthlySalesRevenue]['December'];

  $currentYear_monthlySalesRevenueSalesRevenueChartValues = array($current_january, $current_february, $current_march,
  $current_april, $current_may, $current_june,
  $current_july, $current_august, $current_september,
  $current_october, $current_november, $current_december);
  $jsonCurrentYearSalesRevenueChartValues = json_encode($currentYear_monthlySalesRevenueSalesRevenueChartValues);
  // echo "The JSON values are " . $jsonCurrentYearSalesRevenueChartValues;

  /* Monthly sales revenue for the previous year (for a year-on-year comparison) */
  /* January */
  $previous_january = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['January']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['January'];
  /* February */
  $previous_february = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['February']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['February'];
  /* March */
  $previous_march = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['March']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['March'];
  /* April */
  $previous_april = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['April']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['April'];
  /* May */
  $previous_may = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['May']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['May'];
  /* June */
  $previous_june = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['June']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['June'];
  /* July */
  $previous_july = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['July']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['July'];
  /* August */
  $previous_august = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['August']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['August'];
  /* September */
  $previous_september = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['September']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['September'];
  /* October */
  $previous_october = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['October']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['October'];
  /* November */
  $previous_november = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['November']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['November'];
  /* December */
  $previous_december = !isset($salesRevenue[$previousYear_monthlySalesRevenue]['December']) ? null : $salesRevenue[$previousYear_monthlySalesRevenue]['December'];

  $previousYear_monthlySalesRevenueSalesRevenueChartValues = array($previous_january, $previous_february, $previous_march,
                        $previous_april, $previous_may, $previous_june,
                        $previous_july, $previous_august, $previous_september,
                        $previous_october, $previous_november, $previous_december);
  $jsonPreviousYearSalesRevenueChartValues = json_encode($previousYear_monthlySalesRevenueSalesRevenueChartValues);
  // echo "The JSON values are " . $jsonPreviousYearSalesRevenueChartValues;
?>
<div class="col-md-6 my-1">
  <div class="card">
  <div class="card-body text-center">
    <strong>
      Visualization Type: Line Graph<br>
      Using Line Graph  to track and display trends over time, making them suitable for showing the forecasted sales growth rate over the year<br>
      KPI1a (leading): <u> Forecasted Sales Growth Rate for the Year</u><br>
      Target for the Annual Sales per Product = <?= number_format($salesPerProduct_target,2,".",",") ?> <br>
      Current Year = <?= $currentYear_top5SellingProducts ?>
    </strong>
  </div>
  <div class="card-body"><canvas id="KPI1b"></canvas></div>
</div>
</div>
<div class="col-md-6 my-1">
  <div class="card">
  <div class="card-body text-center">
    <strong>
      Visualization Type: Bar Graph<br>
      Using Bar Graph to compare the profit margin percentages between different periods or categories. It will help visualize the increase in profit margin percentage for the year<br>
      KPI1b (lagging): <u>Profit Margin Percentage</u><br>
      Increased Profit Margin Percentage for the Year = <?= number_format($monthlySalesRevenue_target,2,".",",") ?> <br>
      Current Year = <?= $currentYear_monthlySalesRevenue ?>
    </strong>
  </div>
  <div class="card-body"><canvas id="KPI1a"></canvas></div>
</div>
</div>
<!-- You can use the following website to pick RGBA values: https://rgbacolorpicker.com/ -->
<script>
/* KPI1a */
      const kpi1a = document.getElementById('KPI1a');
    
      new Chart(kpi1a, {
        type: 'bar',
        data: {
          labels: <?= $jsonCurrentYearTop5SellingfullProductDetails ?>,
          datasets: [{
            label: 'Amount',
            data: <?= $jsonCurrentYearTop5SellingSumPriceEach ?>,
            borderWidth: 1,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            pointStyle: 'rectRounded'
          }, {
            type: 'line',
            label: 'Target',
            data: [<?= $salesPerProduct_target; ?>, <?= $salesPerProduct_target; ?>, <?= $salesPerProduct_target; ?>, <?= $salesPerProduct_target; ?>, <?= $salesPerProduct_target; ?>],
            borderWidth: 1.2,
            fill: false,
            borderColor: 'black',
            pointBackgroundColor: 'black',
            pointRadius: 0,
            pointStyle: 'line'
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Amount'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Product Details'
              },
              grid: {
                display: false
              }
            }
          },
          plugins: {
            tooltip: {
              intersect: false
            },
            legend: {
              position: 'bottom',
              labels : {
                usePointStyle: true
              }
            }
          },
          interaction: {
              mode: 'index'
          }
        }
      });

      /* KPI1b */
      const kpi1b = document.getElementById('KPI1b');

      new Chart(kpi1b, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 
          'August', 'September', 'October', 'November', 'December'],
          datasets: [
            {
            type: 'line',
            label: '<?= $currentYear_monthlySalesRevenue ?>',
            data: <?= $jsonCurrentYearSalesRevenueChartValues ?>,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            pointStyle: 'rectRounded'
          }, {
            type: 'line',
            label: '<?= $previousYear_monthlySalesRevenue ?>',
            data: <?= $jsonPreviousYearSalesRevenueChartValues ?>,
            fill: false,
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            pointStyle: 'rectRounded'
          }, {
            type: 'line',
            label: 'Target',
            data: [<?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, 
                  <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>, <?= $monthlySalesRevenue_target ?>],
            borderWidth: 1.2,
            fill: false,
            borderColor: 'black',
            pointBackgroundColor: 'black',
            pointRadius: 0,
            pointStyle: 'line'
          }
        ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Sales'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Month'
              },
              grid: {
                display: false
              }
            }
          },
          plugins: {
            tooltip: {
              intersect: false
            },
            legend: {
              position: 'bottom',
              labels : {
                usePointStyle: true
              }
            }
          },
          interaction: {
              mode: 'index'
          } 
        }
      });
</script>