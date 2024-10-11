var ctx = document.getElementById('myChart_bar').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [], // Initially empty
      datasets: [{
        label: 'Accounts',
        data: [], // Initially empty
        borderWidth: 1,
        backgroundColor: [],
        borderColor: []
      }]
    }
  });

  // Fetch data from PHP script using AJAX
  function fetchData() {
    $.ajax({
      url: '../../process/chart/income_chart.php',
      method: 'GET',
      success: function(response) {
        // Parse the JSON response
        var chartLabels = response.labels;
        var chartData = response.values;
        var chartColors = response.colors;
        var borderColors = response.borderColor;

        // Update the chart's data
        myChart.data.labels = chartLabels;
        myChart.data.datasets[0].data = chartData;
        myChart.data.datasets[0].backgroundColor = chartColors;
        myChart.data.datasets[0].borderColor = borderColors;
        
        // Update the chart to reflect changes
        myChart.update();
      },
      error: function() {
        console.log("Failed to fetch data from PHP script.");
      }
    });
  }

  // Call the function to fetch and update data
  fetchData();
