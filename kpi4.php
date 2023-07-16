<?php
include 'dbconfig.php';

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL EmployeesTraining();";
$result = $conn->query($sql);

// Fetch the data from the result
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the connection
$conn->close();
?>

<div class="col-md-6 my-1">
    <div class="card">
    <div class="card-body text-center">
    <strong>
      Visualization Type: Radar chart<br>
      Using Radar Chart to compare the distribution of training hours across different training topics or departments<br>
      KPI4a (leading): <u> Employee Training Hours per Year </u><br>
      <!-- Customer Satisfaction Index for the Year = <?= number_format($salesPerProduct_target,2,".",",") ?> <br>
      Current Year = <?= $currentYear_top5SellingProducts ?> -->
    </strong>
    </div>
    <div class="card-body"><canvas id="KPI4a"></canvas></div>
    </div>
</div>

<?php
include 'dbconfig.php';

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Call the FarmProductivity procedure
$sql = "CALL `FarmProductivity`();";
$result = $conn->query($sql);

// Fetch data from the result
$years = [];
$productivityIndices = [];

while ($row = $result->fetch_assoc()) {
  $years[] = $row['year'];
  $productivityIndices[] = $row['productivity_index'];
}

// Close the connection
$conn->close();
?>

<div class="col-md-6 my-1">
    <div class="card">
    <div class="card-body text-center">
    <strong>
    Visualization Type: Line Graph<br>
    to track the improvement in farm productivity over time, allowing for easy comparison and identification of trends<br>
      KPI4a (lagging): <u>  Improvement in Farm Productivity</u><br>
      <!-- Customer Satisfaction Index for the Year = <?= number_format($salesPerProduct_target,2,".",",") ?> <br>
      Current Year = <?= $currentYear_top5SellingProducts ?> -->
    </strong>
    </div>
    <div class="card-body"><canvas id="KPI4b"></canvas></div>
</div>
</div>
<script>
      /* KPI4a */
      const topics = <?php echo json_encode(array_column($data, 'topic')); ?>;
        const hours = <?php echo json_encode(array_column($data, 'hours')); ?>;

        const radarChart = document.getElementById('KPI4a').getContext('2d');
        new Chart(radarChart, {
            type: 'radar',
            data: {
                labels: topics,
                datasets: [{
                    label: 'Training Hours',
                    data: hours,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                }]
            },
            options: {
                elements: {
                    line: {
                        borderWidth: 2
                    }
                },
                plugins: {
                    tooltip: {
                        intersect: false
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    }
                },
                interaction: {
                    mode: 'index'
                }
            }
        });

      /* KPI4b */

   
const kpi4b = document.getElementById('KPI4b');

new Chart(kpi4b, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($years); ?>,
    datasets: [
      {
        type: 'line',
        label: 'Farm Productivity',
        data: <?php echo json_encode($productivityIndices); ?>,
        borderWidth: 2,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        pointStyle: 'circle',
        pointRadius: 4,
        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
        pointBorderColor: 'rgba(255, 255, 255, 1)',
        pointBorderWidth: 2,
        fill: false
      }
    ]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Productivity Index'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Year'
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