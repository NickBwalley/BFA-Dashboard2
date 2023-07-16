
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
      KPI2b (lagging): <u> Complaints Received and Resolved during the Year</u><br>
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
      /* KPI2b */
          // Get the customer satisfaction data from the PHP variable
    const customerSatisfactionData = <?php echo json_encode($result->fetch_all(MYSQLI_ASSOC)); ?>;

    // Extract labels and data arrays from the customer satisfaction data
    const labels = customerSatisfactionData.map(record => `${record.year}-${record.month}`);
    const data = customerSatisfactionData.map(record => record.satisfaction_index);

    // Create the Line Graph
    const customerSatisfactionLineGraph = document.getElementById('KPI2b');
    new Chart(customerSatisfactionLineGraph, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Customer Satisfaction Index',
          data: complaintsData.map(complaint => ({
            x: complaint.complaint_resolved,
            y: complaint.complaint_received,
            
          })),
          borderWidth: 2,
          borderColor: 'rgba(9, 50, 219, 0.75)',
          backgroundColor: 'rgba(9, 50, 219, 0.1)',
          fill: false
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
              text: 'Time'
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