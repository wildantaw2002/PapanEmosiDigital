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
    <!-- Emosi Kuning (Senang) -->
    <div data-color="Kuning" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; background-color: #facc15;" title="Senang"></div>
    <!-- Emosi Biru (Terharu) -->
    <div data-color="Biru" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; background-color: #3b82f6;" title="Terharu"></div>
    <!-- Emosi Merah (Marah) -->
    <div data-color="Merah" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; background-color: #ef4444;" title="Marah"></div>
    <!-- Emosi Hijau (Khawatir) -->
    <div data-color="Hijau" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; background-color: #22c55e;" title="Khawatir"></div>
    <!-- Emosi Abu (Cemas) -->
    <div data-color="Abu" style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; background-color: #6b7280;" title="Cemas"></div>
  </div>

  <button id="kirimBtn"
    style="background-color: #10b981; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; transition: background-color 0.2s;">
    Kirim
  </button>

  <p id="result" style="margin-top: 1rem; font-size: 1.125rem; font-weight: 500;"></p>
</div>

<script>
  const emotions = document.querySelectorAll('[data-color]');
  const result = document.getElementById('result');
  let selectedColor = null;

  const ringStyle = '4px solid #1f2937'; // Custom style for the ring

  emotions.forEach(emotion => {
    emotion.addEventListener('click', () => {
      // Remove ring from all emotions
      emotions.forEach(e => e.style.border = 'none');
      
      // Add ring to the selected emotion
      emotion.style.border = ringStyle;
      emotion.style.boxSizing = 'border-box'; // Ensure border doesn't push element out
      selectedColor = emotion.dataset.color;
    });
  });

  document.getElementById('kirimBtn').addEventListener('click', async () => {
    const nama = document.getElementById('nama').value.trim();

    if (!nama || !selectedColor) {
      result.textContent = "Harap isi nama dan pilih warna emosi!";
      result.style.color = '#ef4444'; // Red-500 equivalent
      return;
    }

    result.textContent = `Hai ${nama}, kamu memilih warna ${selectedColor}! (Data dikirim)`;
    result.style.color = '#059669'; // Green-600 equivalent
    
    // --- START: Mock API Call Logic ---
    // In a real application, you would put your 'fetch' call here.
    // Since this is a standalone file, we simulate a successful submission.
    console.log("Simulasi Pengiriman Data Emosi:");
    console.log(`Nama: ${nama}`);
    console.log(`Warna: ${selectedColor}`);
    
    // Optional: Reset form after mock submission
    document.getElementById('nama').value = '';
    emotions.forEach(e => e.style.border = 'none');
    selectedColor = null;
    // --- END: Mock API Call Logic ---
  });
</script>

</body>
</html>