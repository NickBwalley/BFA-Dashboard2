<!-- KPI1a Getting the Highest Profit Revenue Margin -->
<?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "CALL `GetProfitTrends`();";
  $result = $conn->query($sql);

  $conn->close();
?>

<?php
include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// Get data from the 'profit_trends' table
$query = "SELECT year_2022_profit, year_2023_profit FROM profit_trends";
$result = $conn->query($query);

// Initialize arrays to store data
$year2022Profit = [];
$year2023Profit = [];

// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
  $year2022Profit[] = $row['year_2022_profit'];
  $year2023Profit[] = $row['year_2023_profit'];
}

// Close the database connection
$conn->close();
?>

<div class="col-md-6 my-1">
  <div class="card">
  <div class="card-body text-center">
    <strong>
      Visualization Type: Line Graph<br>
      Using Line Graph  to track and display trends over time, making them suitable for showing the forecasted sales growth rate over the year<br>
      KPI1a (leading): <u> Forecasted Sales Growth Rate for the Year</u><br>
      
    </strong>
  </div>
  <div class="card-body"><canvas id="KPI1a"></canvas></div>
</div>
</div>
<div class="col-md-6 my-1">
  <div class="card">
  <div class="card-body text-center">
    <strong>
      Visualization Type: Bar Graph<br>
      Using Bar Graph to compare the profit margin percentages between different periods or categories. It will help visualize the increase in profit margin percentage for the year<br>
      KPI1b (lagging): <u>Profit Margin Percentage</u><br>
      
    </strong>
  </div>
  <div class="card-body"><canvas id="KPI1b"></canvas></div>
</div>
</div>

  <script>
    // Get the canvas element
    const profitTrendsChart = document.getElementById('KPI1a');
    
    // Retrieve the profit data from the database or use static values
    // const year2022Profit = [500000, 750000, 650000, 900000, 1000000, 1300000, 1200000, 1900000, 2200000, 2500000, 2300000, 3100000];
    // const year2023Profit = [1000000, 1300000, 2000000, 1900000, 2100000, 3500000, 3200000];
    
    // Set the target value
  const targetValue = 3000000;
  
  // Create the line graph
  new Chart(profitTrendsChart, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Year 2022',
        data: <?= json_encode($year2022Profit) ?>,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        pointStyle: 'rectRounded',
        fill: false
      }, {
        label: 'Year 2023',
        data: <?= json_encode($year2023Profit) ?>,
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        pointStyle: 'rectRounded',
        fill: false
      }, {
        label: 'Target',
        data: Array(12).fill(targetValue),
        borderColor: 'rgba(0, 0, 0, 1)',
        backgroundColor: 'rgba(0, 0, 0, 0.1)',
        pointStyle: 'line',
        fill: false,
        borderDash: [5, 5]
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Amount'
          },
          ticks: {
            min: 100000,
            max: 6000000
          }
        },
        x: {
          title: {
            display: true,
            text: 'Months'
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
      }
    }
  });

    // KPI1b: A BAR GRAPH REPRESENTATION FOR IT. 
    // Get the canvas element
    const profitTrendsChart1 = document.getElementById('KPI1b');
    
    // Retrieve the profit data from the database or use static values
    const year2022Profit1 = [120000, 250000, 500000, 750000, 1000000, 1300000, 1600000, 1900000, 2200000, 2500000, 2800000, 3100000];
    const year2023Profit1 = [150000, 350000, 600000, 900000, 1250000, 1650000, 2100000, 2600000, 3200000, 3900000, 4700000, 5600000];
    
    // Create the bar graph
new Chart(profitTrendsChart1, {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      label: 'Year 2022',
      data: <?= json_encode($year2022Profit) ?>,
      backgroundColor: 'rgba(54, 162, 235, 0.5)',
    }, {
      label: 'Year 2023',
      data: <?= json_encode($year2023Profit) ?>,
      backgroundColor: 'rgba(255, 99, 132, 0.5)',
    }, {
      label: 'Target',
      data: Array(12).fill(3000000),
      borderColor: 'rgba(0, 0, 0, 1)',
      backgroundColor: 'rgba(0, 0, 0, 0.1)',
      type: 'line',
      fill: false,
      borderDash: [5, 5]
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Amount'
        },
        ticks: {
          min: 100000,
          max: 6000000
        }
      },
      x: {
        title: {
          display: true,
          text: 'Months'
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
    }
  }
});

  </script>