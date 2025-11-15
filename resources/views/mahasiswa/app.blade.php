<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mahasiswa - Papan Emosi Digital</title>
</head>
<body style="background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; font-family: sans-serif;">

<div id="emotion-card" style="background-color: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05); width: 100%; max-width: 28rem; text-align: center; box-sizing: border-box;">
  <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: #1f2937;">Papan Emosi Digital</h2>
  <p style="color: #4b5563; margin-bottom: 1.5rem;">Masukkan nama Anda dan pilih warna emosi Anda hari ini:</p>

  @if ($message = Session::get('success'))
    <div style="background-color: #d1fae5; border: 1px solid #6ee7b7; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; color: #065f46;">
      <strong>Sukses!</strong> {{ $message }}
    </div>
  @endif

  <!-- Form HTML tradisional -->
  <form method="POST" action="/emosi/submit" style="display: flex; flex-direction: column; gap: 1.5rem;">
    @csrf

    <input type="text" name="nama" placeholder="Nama Mahasiswa" required
      style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.5rem 1rem; box-sizing: border-box;">

    <div style="display: flex; justify-content: space-around;">
      
      <!-- Emosi Senang -->
      <label style="display: flex; flex-direction: column; align-items: center; cursor: pointer;">
        <input type="radio" name="warna" value="Kuning" required style="display: none;">
        <div class="emotion-radio" data-color="Kuning" title="Senang"
          style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #facc15;">
          ☺️
        </div>
        <small style="margin-top: 0.25rem; font-size: 0.75rem;">Senang</small>
      </label>

      <!-- Emosi Terharu -->
      <label style="display: flex; flex-direction: column; align-items: center; cursor: pointer;">
        <input type="radio" name="warna" value="Biru" required style="display: none;">
        <div class="emotion-radio" data-color="Biru" title="Terharu"
          style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #3b82f6;">
          🥹
        </div>
        <small style="margin-top: 0.25rem; font-size: 0.75rem;">Terharu</small>
      </label>

      <!-- Emosi Marah -->
      <label style="display: flex; flex-direction: column; align-items: center; cursor: pointer;">
        <input type="radio" name="warna" value="Merah" required style="display: none;">
        <div class="emotion-radio" data-color="Merah" title="Marah"
          style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #ef4444;">
          😡
        </div>
        <small style="margin-top: 0.25rem; font-size: 0.75rem;">Marah</small>
      </label>

      <!-- Emosi Khawatir -->
      <label style="display: flex; flex-direction: column; align-items: center; cursor: pointer;">
        <input type="radio" name="warna" value="Hijau" required style="display: none;">
        <div class="emotion-radio" data-color="Hijau" title="Khawatir"
          style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #22c55e;">
          😟
        </div>
        <small style="margin-top: 0.25rem; font-size: 0.75rem;">Khawatir</small>
      </label>

      <!-- Emosi Cemas -->
      <label style="display: flex; flex-direction: column; align-items: center; cursor: pointer;">
        <input type="radio" name="warna" value="Abu" required style="display: none;">
        <div class="emotion-radio" data-color="Abu" title="Cemas"
          style="width: 3.5rem; height: 3.5rem; border-radius: 50%; cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #d1d5db; background-color: #6b7280;">
          😰
        </div>
        <small style="margin-top: 0.25rem; font-size: 0.75rem;">Cemas</small>
      </label>
    </div>

    <!-- Button Container -->
    <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: center;">
      <button type="submit"
        style="background-color: #10b981; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; transition: background-color 0.2s; min-width: 10rem;">
        Kirim
      </button>

      <a href="/guru/dashboard"
        style="background-color: #3b82f6; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; border: none; cursor: pointer; transition: background-color 0.2s; min-width: 10rem; text-decoration: none; display: inline-block; text-align: center;">
        Ke Dashboard Guru
      </a>
    </div>

    <p id="result" style="margin-top: 1rem; font-size: 1.125rem; font-weight: 500;"></p>
  </form>
</div>

<script>
  const emotionRadios = document.querySelectorAll('.emotion-radio');
  const ringStyle = '4px solid #1f2937';
  const defaultBorderStyle = '1px solid #d1d5db';

  // Handle emotion selection with visual feedback
  emotionRadios.forEach(radio => {
    radio.addEventListener('click', () => {
      // Remove ring from all
      emotionRadios.forEach(r => r.style.border = defaultBorderStyle);
      
      // Add ring to selected
      radio.style.border = ringStyle;
      radio.style.boxSizing = 'border-box';
      
      // Check the hidden radio input
      const label = radio.closest('label');
      label.querySelector('input[type="radio"]').checked = true;
    });
  });

  // Optional: Set initial ring if a radio is pre-checked
  document.querySelectorAll('input[name="warna"]:checked').forEach(input => {
    input.closest('label').querySelector('.emotion-radio').style.border = ringStyle;
    input.closest('label').querySelector('.emotion-radio').style.boxSizing = 'border-box';
  });
</script>

</body>
</html>