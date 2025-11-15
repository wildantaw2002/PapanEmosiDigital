<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
  <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md text-center">
    <h2 class="text-2xl font-bold mb-2 text-gray-800">Papan Emosi Digital</h2>
    <p class="text-gray-600 mb-6">Masukkan nama Anda dan pilih warna emosi Anda hari ini:</p>

    <input type="text" id="nama" placeholder="Nama Mahasiswa"
      class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-6 focus:outline-none focus:ring-2 focus:ring-green-500">

    <div class="flex justify-around mb-6">
      <div class="w-14 h-14 rounded-full cursor-pointer transition transform hover:scale-110 bg-yellow-400" data-color="Kuning"></div>
      <div class="w-14 h-14 rounded-full cursor-pointer transition transform hover:scale-110 bg-blue-500" data-color="Biru"></div>
      <div class="w-14 h-14 rounded-full cursor-pointer transition transform hover:scale-110 bg-red-500" data-color="Merah"></div>
      <div class="w-14 h-14 rounded-full cursor-pointer transition transform hover:scale-110 bg-green-500" data-color="Hijau"></div>
      <div class="w-14 h-14 rounded-full cursor-pointer transition transform hover:scale-110 bg-gray-500" data-color="Abu"></div>
    </div>

    <button id="kirimBtn"
      class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition">
      Kirim
    </button>

    <p id="result" class="mt-4 text-lg font-medium"></p>
  </div>
</div>

<script type="module">
  const emotions = document.querySelectorAll('[data-color]');
  const result = document.getElementById('result');
  let selectedColor = null;

  emotions.forEach(emotion => {
    emotion.addEventListener('click', () => {
      emotions.forEach(e => e.classList.remove('ring-4', 'ring-gray-800'));
      emotion.classList.add('ring-4', 'ring-gray-800');
      selectedColor = emotion.dataset.color;
    });
  });

  document.getElementById('kirimBtn').addEventListener('click', async () => {
    const nama = document.getElementById('nama').value;

    if (!nama || !selectedColor) {
      result.textContent = "Harap isi nama dan pilih warna emosi!";
      result.classList.add('text-red-500');
      return;
    }

    result.textContent = `Hai ${nama}, kamu memilih warna ${selectedColor}!`;
    result.classList.remove('text-red-500');
    result.classList.add('text-green-600');

    // Contoh kirim ke backend Laravel (aktifkan kalau backend sudah siap)
    try {
      const response = await fetch("{{ url('/api/emosi') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ nama: nama, warna: selectedColor }),
      });

      const data = await response.json();
      console.log("Respon dari server:", data);
      if (response.ok) {
        // sudah ditangani di atas; tambahkan reset jika perlu
      } else {
        console.error(data);
      }
    } catch (err) {
      console.error(err);
    }
  });
</script>


</body>
</html>