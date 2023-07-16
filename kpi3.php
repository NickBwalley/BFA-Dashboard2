<?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "CALL `PROCESSINGMANUFACTURE`();";
  $result = $conn->query($sql);
?>

<div class="col-md-6 my-1">
    <div class="card">
    <div class="card-body text-center">
    <strong>
      Visualization Type: Bar Graph<br>
      Using Bar Graph to compare the average time for tea leaves processing between different periods or categories. It will help visualize any changes or improvements in processing time<br>
      KPI3a (leading): <u> Average Time for Tea Leaves Processing</u><br>
      <!-- Customer Satisfaction Index for the Year = <?= number_format($salesPerProduct_target,2,".",",") ?> <br>
      Current Year = <?= $currentYear_top5SellingProducts ?> -->
    </strong>
    </div>
    <div class="card-body"><canvas id="KPI3a"></canvas></div>
    </div>
</div>

<?php
  // include 'dbconfig.php';

  // // Create connection
  // $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // // Check connection
  // if ($conn->connect_error) {
  //   die("Connection failed: " . $conn->connect_error);
  // }
  
  // $sql = "CALL `QualityProcess`();";
  // $result = $conn->query($sql);
?>

<div class="col-md-6 my-1">
  <div class="card">
    <div class="card-body text-center">
      <strong>
        Visualization Type: Bar Graph<br>
        Using a bar graph <br>
        KPI3b (lagging): <u>Increased Quality of the Processed Tea Leaves</u><br>
        <!-- Customer Satisfaction Index for the Year = <?= number_format($salesPerProduct_target,2,".",",") ?> <br>
        Current Year = <?= $currentYear_top5SellingProducts ?> -->
      </strong>
    </div>
    <div class="card-body">
      <canvas id="KPI3b"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the processing data from the PHP variable
const processingData = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

// Extract labels and data arrays from the processing data
const procinglabels = processingData.map(record => record.category);
const processingDataArray = processingData.map(record => record.average_processing_time);

// Create the Bar Graph
const processingTimeBarGraph = document.getElementById('KPI3a');
new Chart(processingTimeBarGraph, {
  type: 'bar',
  data: {
    labels: procinglabels,
    datasets: [{
      label: 'Average Processing Time',
      data: processingDataArray,
      backgroundColor: 'rgb(54, 162, 235)'
    }, {
      type: 'line',
      label: 'Target',
      data: [9.5, 9.5, 9.5, 9.5, 9.5, 9.5, 9.5], // Add target data (9.5 for all categories)
      borderWidth: 2,
      borderColor: 'rgba(255, 99, 132, 1)',
      fill: false
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Average Processing Time'
        },
        ticks: {
          min: 0,
          max: 10
        }
      },
      x: {
        title: {
          display: true,
          text: 'Category'
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
   // Retrieve the data from the result of the stored procedure
   <?php
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row['total_quality'];
    }
  ?>

  // Create the Line Graph
const processingTimeLineGraph = document.getElementById('KPI3b');
new Chart(processingTimeLineGraph, {
  type: 'line',
  data: {
    labels: procinglabels,
    datasets: [{
      label: 'Quality of the Tea',
      data: processingDataArray,
      borderColor: 'rgb(54, 162, 235)',
      fill: false
    }, {
      type: 'line',
      label: 'Target',
      data: [9.5, 9.5, 9.5, 9.5, 9.5, 9.5, 9.5], // Add target data (9.5 for all categories)
      borderWidth: 2,
      borderColor: 'rgba(255, 99, 132, 1)',
      fill: false
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Customer Rating'
        },
        ticks: {
          min: 0,
          max: 10
        }
      },
      x: {
        title: {
          display: true,
          text: 'Category'
        }
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


  // Create the polar area chart
  // const kpi3b = document.getElementById('KPI3b');
  // new Chart(kpi3b, {
  //   type: 'line',
  //   data: {
  //     labels: <?php echo json_encode(array_keys($data)); ?>,
  //     datasets: [{
  //       label: 'Quality',
  //       data: <?php echo json_encode(array_values($data)); ?>,
  //       backgroundColor: [
  //         'rgb(255, 99, 132)',
  //         'rgb(54, 162, 235)',
  //         'rgb(255, 205, 86)'
  //       ],
  //       hoverOffset: 4
  //     }]
  //   },
  //   options: {
  //     plugins: {
  //       tooltip: {
  //         intersect: false
  //       },
  //       legend: {
  //         position: 'bottom',
  //         labels: {
  //           usePointStyle: true
  //         }
  //       }
  //     },
  //     interaction: {
  //       mode: 'index'
  //     }
  //   }
  // });

      
</script>