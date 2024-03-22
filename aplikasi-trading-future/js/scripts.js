function getData() {
  return fetch('getData.php')
    .then(response => response.json())
    .then(data => {
      let groupedData = data.reduce((acc, curr) => {
        if (!acc[curr]) {
          acc[curr] = 0;
        }
        acc[curr]++;
        return acc;
      }, {});

      let chartData = {
        labels: Object.keys(groupedData),
        datasets: [{
          label: 'Grafik profit dan loss',
          data: Object.values(groupedData),
          backgroundColor: ['green', 'red'],
          borderColor: 'white',
          borderWidth: 1
        }]
      };

      return chartData;
    });
}

// Memuat data ke chart saat halaman dimuat
getData().then(data => {
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      title: {
        display: true,
        text: 'Chart Title',
        fontColor: 'white' // Mengatur warna teks judul menjadi putih
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            fontColor: 'white' // Mengatur warna teks sumbu Y menjadi putih
          }
        }],
        xAxes: [{
          ticks: {
            fontColor: 'white' // Mengatur warna teks sumbu X menjadi putih
          }
        }]
      },
      legend: {
        labels: {
          fontColor: 'white' // Mengatur warna teks legenda menjadi putih
        }
      }
    }
  });
});