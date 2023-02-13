const chart = document.getElementById('complaint_chart');

var violation = JSON.parse('{!! json_encode($violation) !!}')
var complaint = JSON.parse('{!! json_encode($complaint) !!}')

new Chart(chart, {
    type: 'bar',
    data: {
        labels: violation,
        datasets: [{
            label: 'Jumlah Pengaduan',
            data: complaint,
            borderWidth: 1,
            backgroundColor: '#1c9285'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 20,
                ticks: {stepSize: 1}
            },
        },
    }
});
