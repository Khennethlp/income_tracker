const myChart_pie = document.getElementById('myChart_pie');
const myChart_bar = document.getElementById('myChart_bar');
const myChart_radar = document.getElementById('myChart_radar');

new Chart(myChart_pie, {
  type: 'pie',
  data: {
    labels: ['Blue', 'Red', 'Orange', 'Yellow', 'Green', 'Purple'],
    datasets: [{
      // label: '# of Votes',
      data: [1000, 1900, 300, 500, 200, 300],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

new Chart(myChart_bar, {
  type: 'bar',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: '# of Votes',
      data: [1200, 1100, 300, 500, 200, 300],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

new Chart(myChart_radar, {
  type: 'radar',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: '# of Votes',
      data: [1200, 1900, 300, 500, 200, 300],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});