
<?php
  include 'dbconfig.php';

  // Create connection
  $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "CALL `complaintreceivedandresolved`();";
  $result = $conn->query($sql);

  $conn->close();
?>

<?php
  // include 'dbconfig.php';

  // // Create connection
  // $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
  // // Check connection
  // if ($conn->connect_error) {
  //   die("Connection failed: " . $conn->connect_error);
  // }
  
  // $sql = "CALL `CUSTOMERSASTIFICATIONINDEX`();";
  // $result = $conn->query($sql);
  
  // $conn->close();
?>

<div class="col-md-6 my-1">
    <div class="card">
    <div class="card-body text-center">
    <strong>
      Visualization Type: Bubble Chart<br>
      Using Bubble Chart to represent each complaint as a bubble, where the x-axis represents the number of complaints resolved, the y-axis represents the number of complaints received, and the size of the bubbles represents the severity or impact of each complaint. This helps to visualize the distribution of complaints based on their resolution and the overall volume of complaints<br>
      KPI2a (leading): <u> Complaints Received and Resolved during the Year</u><br>

    </strong>
    </div>
    <div class="card-body"><canvas id="KPI2a"></canvas></div>
</div>
</div>

<div class="col-md-6 my-1">
    <div class="card">
    <div class="card-body text-center">
    <strong>
     Visualization Type: Line Graph<br>
     Using Line graph to effectively display the trend of customer satisfaction index over time, allowing you to track changes and compare the index between different periods<br>
      KPI2b (lagging): <u> Customer Satisfaction Index for the Year</u><br>
    </strong>
    </div>
    <div class="card-body"><canvas id="KPI2b"></canvas></div>
</div>
</div>
<script>
    // Get the complaints data from the PHP variable
    const complaintsData = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

    // Create the Bubble Chart
    const complaintsBubbleChart = document.getElementById('KPI2a');
    new Chart(complaintsBubbleChart, {
      type: 'bubble',
      data: {
        datasets: [{
          label: 'Complaints',
          data: complaintsData.map(complaint => ({
            x: complaint.complaint_resolved,
            y: complaint.complaint_received,
            r: complaint.complaint_severity
          })),
          backgroundColor: 'rgba(238, 36, 56, 0.7)'
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Complaints Received'
            }
          },
          x: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Complaints Resolved'
            }
          }
        },
        plugins: {
          tooltip: {
            intersect: true
          },
          legend: {
            position: 'bottom',
            labels : {
              usePointStyle: true
            }
          }
        },
        interaction: {
          mode: 'point'
        } 
      }
    });
    <?php
        include 'dbconfig.php';

          // Create connection
          $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
        // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

        // Get data from the 'profit_trends' table
        $query = "SELECT date_column, customer_satisfaction_index FROM customer_satisfaction";
        $result = $conn->query($query);

        // Initialize arrays to store data
        $users = [];
        $satisfactionIndex = [];

        // Process the result set
        while ($row = mysqli_fetch_assoc($result)) {
          $users[] = $row['date_column'];
          $satisfactionIndex[] = $row['customer_satisfaction_index'];
        }

        // Close the database connection
        $conn->close();
        ?>
      // Get the canvas element
const customerSatisfactionChart = document.getElementById('KPI2b');

// Retrieve the customer satisfaction data from the database or use static values
const users = <?php echo json_encode($users); ?>; // Array of user IDs
const satisfactionIndex = <?php echo json_encode($satisfactionIndex); ?>; // Array of customer satisfaction indices
const target3 = 8.0; // Target value

// Create the line graph
new Chart(customerSatisfactionChart, {
  type: 'line',
  data: {
    labels: users,
    datasets: [{
      label: 'Customer Satisfaction Index',
      data: satisfactionIndex,
      borderColor: 'rgba(54, 162, 235, 1)',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      pointStyle: 'circle',
      pointRadius: 4,
      pointBackgroundColor: 'rgba(54, 162, 235, 1)',
      pointBorderColor: 'rgba(255, 255, 255, 1)',
      pointBorderWidth: 2,
      fill: false
    }, {
      type: 'line',
      label: 'Target',
      data: Array(satisfactionIndex.length).fill(target3),
      borderWidth: 1.2,
      fill: false,
      borderColor: 'black',
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
          text: 'Customer Satisfaction Index'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Date Column'
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
</script>