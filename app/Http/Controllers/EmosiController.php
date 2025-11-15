<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emosi;
use Illuminate\Support\Facades\DB;

class EmosiController extends Controller
{
    // Simpan data emosi dari form submission (tradisional)
    public function submit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'warna' => 'required|string|max:50'
        ]);

        Emosi::create([
            'nama' => $request->nama,
            'emosi' => $request->warna
        ]);

        return redirect('/')->with('success', 'Terima kasih ' . $request->nama . '! Emosi Anda telah tersimpan.');
    }

    // Tampilkan semua data untuk guru (API JSON)
    public function index()
    {
        $data = Emosi::latest()->get();
        return response()->json($data);
    }

    // Statistik warna (untuk grafik)
    public function statistik()
    {
        // gunakan kolom 'emosi' dari tabel dan beri alias 'warna' untuk konsistensi respon
        $statistik = Emosi::select('emosi as warna', DB::raw('count(*) as total'))
            ->groupBy('emosi')
            ->get();

        return response()->json($statistik);
    }
}
