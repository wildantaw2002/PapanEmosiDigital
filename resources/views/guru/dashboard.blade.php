<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Guru - Papan Emosi Digital</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 p-8">
  <h1 class="text-3xl font-bold mb-6 text-center text-green-700">Dashboard Guru</h1>

  <div class="grid md:grid-cols-2 gap-6">
    <!-- Tabel Data Mahasiswa -->
    @php
      // Mapping warna lama -> emoji dan keterangan
      $emojiMap = [
        'Kuning' => '☺️',
        'Biru'   => '🥹',
        'Merah'  => '😡',
        'Hijau'  => '😟',
        'Abu'    => '😰',
      ];
      $descMap = [
        'Kuning' => 'Senang',
        'Biru'   => 'Terharu',
        'Merah'  => 'Marah',
        'Hijau'  => 'Khawatir',
        'Abu'    => 'Cemas',
      ];
    @endphp

    <div class="bg-white p-6 rounded-xl shadow-lg">
      <h2 class="text-xl font-semibold mb-4 text-gray-700">Data Mahasiswa</h2>
      <table class="w-full border border-gray-200 text-sm">
        <thead class="bg-green-500 text-white">
          <tr>
            <th class="py-2 px-3">Nama</th>
            <th class="py-2 px-3">Emosi</th>
            <th class="py-2 px-3">Keterangan</th>
            <th class="py-2 px-3">Waktu</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $item)
          <tr class="border-t text-center">
            <td class="py-2 px-3">{{ $item->nama }}</td>
            <td class="py-2 px-3 text-2xl">{{ $emojiMap[$item->emosi] ?? '❓' }}</td>
            <td class="py-2 px-3">{{ $descMap[$item->emosi] ?? $item->emosi }}</td>
            <td class="py-2 px-3">{{ $item->created_at->diffForHumans() }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>


    <div class="bg-white p-6 rounded-xl shadow-lg">
      <h2 class="text-xl font-semibold mb-4 text-gray-700">Statistik Warna Emosi</h2>
      <canvas id="chartEmosi"></canvas>
    </div>
  </div>

  <script>
    async function loadStatistik() {
      const res = await fetch('/api/emosi/statistik');
      const data = await res.json();

      // total semua pilihan
      const totalSum = data.reduce((s, d) => s + Number(d.total), 0);

      // mapping warna ke hex serta emoji dan keterangan
      const colorMap = {
        'Kuning': '#facc15',
        'Biru': '#3b82f6',
        'Merah': '#ef4444',
        'Hijau': '#22c55e',
        'Abu': '#6b7280'
      };
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

      // labels asli (nama warna) dan label yang menyertakan emoji + keterangan + persentase
      const labelsRaw = data.map(d => d.warna);
      const totals = data.map(d => d.total);
      const bgColors = labelsRaw.map(l => colorMap[l] || '#6b7280');
      const labelsWithPct = data.map(d => {
        const pct = totalSum > 0 ? Math.round((d.total / totalSum) * 100) : 0;
        const emoji = emojiMap[d.warna] || '';
        const desc = descMap[d.warna] || d.warna;
        return `${emoji} ${desc} (${pct}%)`;
      });

      // buat chart (jika sudah ada, hapus dulu)
      const ctx = document.getElementById('chartEmosi');
      if (ctx._chartInstance) {
        ctx._chartInstance.destroy();
      }

      ctx._chartInstance = new Chart(ctx, {
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
    }

    loadStatistik();
  </script>
</body>
</html>
