<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papan Emosi Digital</title>

  <!-- Chart.js CDN for the chart functionality -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>

<body style="background-color: #f3f4f6; padding: 2rem; font-family: sans-serif;">

  <h1 style="font-size: 1.875rem; font-weight: 700; margin-bottom: 1.5rem; text-align: center; color: #047857;">Dashboard Guru</h1>

  <!-- Container for the two cards, defaulting to a stacked layout -->
  <div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 1200px; margin-left: auto; margin-right: auto;">

    <!-- Tabel Data Mahasiswa -->
    <div style="background-color: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);">
      <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Data Mahasiswa</h2>
      <table style="width: 100%; border-collapse: collapse; border: 1px solid #e5e7eb; font-size: 0.875rem;">
        <thead style="background-color: #10b981; color: white;">
          <tr>
            <th style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">Nama</th>
            <th style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">Emosi</th>
            <th style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">Keterangan</th>
            <th style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">Waktu</th>
          </tr>
        </thead>
        <tbody id="table-body" style="text-align: center;">
          <!-- Data akan dimuat dari API -->
        </tbody>
      </table>
    </div>

    <!-- Chart -->
    <div style="background-color: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);">
      <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; color: #374151;">Statistik Warna Emosi</h2>
      <canvas id="chartEmosi"></canvas>
    </div>

  </div>

  <script>
    const emojiMap = {
      'Kuning': '☺️',
      'Biru': '🥹',
      'Merah': '😡',
      'Hijau': '😟',
      'Abu': '😰'
    };

    const descMap = {
      'Kuning': 'Senang',
      'Biru': 'Terharu',
      'Merah': 'Marah',
      'Hijau': 'Khawatir',
      'Abu': 'Cemas'
    };

    // Load table data
    fetch('/emosi', {
      credentials: 'same-origin',
      headers: { 'Accept': 'application/json' }
    })
    .then(response => {
      if (!response.ok) throw new Error('Failed to fetch data');
      return response.json();
    })
    .then(dataList => {
      const tbody = document.getElementById('table-body');
      tbody.innerHTML = ''; // Clear existing rows

      if (dataList.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="padding: 1rem; color: #999;">Tidak ada data</td></tr>';
        return;
      }

      dataList.forEach(item => {
        const row = document.createElement('tr');
        row.style.borderTop = '1px solid #e5e7eb';

        const emoji = emojiMap[item.emosi] || '';
        const desc = descMap[item.emosi] || item.emosi;

        row.innerHTML = `
          <td style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">${item.nama}</td>
          <td style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem; font-size: 1.5rem;">${emoji}</td>
          <td style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">${desc}</td>
          <td style="padding-top: 0.5rem; padding-bottom: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem;">Baru</td>
        `;

        tbody.appendChild(row);
      });
    })
    .catch(error => console.error('Error loading table data:', error));

    // Color, emoji, and description mappings
    const colorMap = {
      'Kuning': '#facc15',
      'Biru': '#3b82f6',
      'Merah': '#ef4444',
      'Hijau': '#22c55e',
      'Abu': '#6b7280'
    };

    // Fetch actual data from API
    fetch('/emosi/statistik', {
      credentials: 'same-origin',
      headers: { 'Accept': 'application/json' }
    })
    .then(response => {
      if (!response.ok) throw new Error('Failed to fetch statistics');
      return response.json();
    })
    .then(dataChart => {
      // Calculate total
      const totalSum = dataChart.reduce((s, d) => s + d.total, 0);

      // Build labels with percentage
      const labelsWithPct = dataChart.map(d => {
        const pct = totalSum > 0 ? Math.round((d.total / totalSum) * 100) : 0;
        return `${emojiMap[d.warna] || ''} ${descMap[d.warna] || d.warna} (${pct}%)`;
      });

      // Extract totals and colors
      const totals = dataChart.map(d => d.total);
      const bgColors = dataChart.map(d => colorMap[d.warna] || '#6b7280');

      // Create chart
      const ctx = document.getElementById('chartEmosi');
      if (typeof Chart !== 'undefined') {
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: labelsWithPct,
            datasets: [{
              data: totals,
              backgroundColor: bgColors,
              borderColor: '#ffffff',
              borderWidth: 2
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'bottom' },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    const idx = context.dataIndex;
                    const value = context.dataset.data[idx];
                    const pct = totalSum > 0 ? ((value / totalSum) * 100).toFixed(1) : 0;
                    return `${context.label.replace(/ \(.*\)$/, '')}: ${value} (${pct}%)`;
                  }
                }
              }
            }
          }
        });
      } else {
        console.error("Chart.js library not loaded.");
      }
    })
    .catch(error => console.error('Error loading chart data:', error));
  </script>
</body>
</html>