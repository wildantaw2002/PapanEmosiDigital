<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mahasiswa - Papan Emosi Digital</title>
</head>
<body style="background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; font-family: sans-serif;">

<div id="emotion-card" style="background-color: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 28rem; text-align: center; box-sizing: border-box;">
  <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: #1f2937;">Papan Emosi Digital</h2>
  <p style="color: #4b5563; margin-bottom: 1.5rem;">Masukkan nama Anda dan pilih warna emosi Anda hari ini:</p>

  <input type="text" id="nama" placeholder="Nama Mahasiswa"
    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.5rem 1rem; margin-bottom: 1.5rem; box-sizing: border-box;">

  <div style="display: flex; justify-content: space-around; margin-bottom: 1.5rem;">
    
    <!-- Emosi Senang -->
    <div style="display: flex; flex-direction: column; align-items: center;">
      <div data-color="Kuning" title="Senang"
        style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #facc15;">
        ☺️
      </div>
      <small style="margin-top: 0.25rem; font-size: 0.75rem;">Senang</small>
    </div>

    <!-- Emosi Terharu -->
    <div style="display: flex; flex-direction: column; align-items: center;">
      <div data-color="Biru" title="Terharu"
        style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #3b82f6;">
        🥹
      </div>
      <small style="margin-top: 0.25rem; font-size: 0.75rem;">Terharu</small>
    </div>

    <!-- Emosi Marah -->
    <div style="display: flex; flex-direction: column; align-items: center;">
      <div data-color="Merah" title="Marah"
        style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #ef4444;">
        😡
      </div>
      <small style="margin-top: 0.25rem; font-size: 0.75rem;">Marah</small>
    </div>

    <!-- Emosi Khawatir -->
    <div style="display: flex; flex-direction: column; align-items: center;">
      <div data-color="Hijau" title="Khawatir"
        style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #22c55e;">
        😟
      </div>
      <small style="margin-top: 0.25rem; font-size: 0.75rem;">Khawatir</small>
    </div>

    <!-- Emosi Cemas -->
    <div style="display: flex; flex-direction: column; align-items: center;">
      <div data-color="Abu" title="Cemas"
        style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #6b7280;">
        😰
      </div>
      <small style="margin-top: 0.25rem; font-size: 0.75rem;">Cemas</small>
    </div>
  </div>

  <!-- Button Container to hold both buttons, stacked and centered -->
  <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: center;">
      <button id="kirimBtn"
        style="background-color: #10b981; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; transition: background-color 0.2s; min-width: 10rem;">
        Kirim
      </button>

      <button id="dashboardBtn"
        style="background-color: #3b82f6; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; transition: background-color 0.2s; min-width: 10rem;">
        Ke Dashboard Guru
      </button>
  </div>

  <p id="result" style="margin-top: 1rem; font-size: 1.125rem; font-weight: 500;"></p>
</div>

<script>
  const emotions = document.querySelectorAll('[data-color]');
  const result = document.getElementById('result');
  let selectedColor = null;

  const ringStyle = '4px solid #1f2937'; // Border style for selected emotion
  const defaultBorderStyle = '1px solid #d1d5db';

  // Highlight warna yang dipilih
  emotions.forEach(emotion => {
    emotion.addEventListener('click', () => {
      // Remove ring from all emotions
      emotions.forEach(e => e.style.border = defaultBorderStyle);
      
      // Add ring to the selected emotion
      emotion.style.border = ringStyle;
      emotion.style.boxSizing = 'border-box';
      selectedColor = emotion.dataset.color;
    });
  });

  // Tombol kirim
  document.getElementById('kirimBtn').addEventListener('click', async () => {
    const nama = document.getElementById('nama').value.trim();

    if (!nama || !selectedColor) {
      result.textContent = "Harap isi nama dan pilih warna emosi!";
      result.style.color = '#ef4444'; // Red-500 equivalent
      return;
    }

    // --- START: Mock Submission Logic (Replaces API call) ---
    console.log("Simulasi Pengiriman Data Emosi:");
    console.log(`Nama: ${nama}`);
    console.log(`Warna: ${selectedColor}`);
    
    // Simulate successful response
    result.textContent = `Terima kasih, ${nama}! Kamu memilih warna ${selectedColor}. (Simulasi berhasil)`;
    result.style.color = '#059669'; // Green-600 equivalent
    
    // Reset form
    document.getElementById('nama').value = "";
    emotions.forEach(e => e.style.border = defaultBorderStyle);
    selectedColor = null;

    // --- END: Mock Submission Logic ---
  });

  // Tombol ke Dashboard Guru (DIFIX untuk navigasi ke path Laravel)
  const dashboardBtn = document.getElementById('dashboardBtn');
  dashboardBtn.addEventListener('click', () => {
    // Navigasi yang sebenarnya: Mengarahkan ke path /guru/dashboard
    window.location.href = '/guru/dashboard';
    
    // Memberikan pesan visual sebelum navigasi
    result.textContent = "Mengarahkan ke Dashboard Guru (/guru/dashboard)...";
    result.style.color = '#3b82f6'; 
  });
</script>

</body>
</html>