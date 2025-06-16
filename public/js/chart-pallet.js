document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chartPallet').getContext('2d');
const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels, // ← pakai variabel global dari view
            datasets: [{
                label: 'Total Pallet per Jam',
                data: chartData,   // ← pakai variabel global dari view
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true,
                tension: 0.4
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
});