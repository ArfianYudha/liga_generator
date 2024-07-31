<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;
use App\Models\M_tim;
use App\Models\Klasemen;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class MyturnamenController extends Controller
{
    public function index()
    {
        // Mengambil ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Mengambil turnamen yang dimiliki oleh pengguna yang sedang login
        $turnamen = Turnamen::where('id_users', $userId)->orderBy('created_at', 'desc')->get();
    
        // Mengirim data turnamen ke tampilan
        return view('pages.landing-page.myturnamen.index', compact('turnamen'));
    }

    public function my_detail($id)
    {
        $turnamen = Turnamen::findOrFail($id);
        return view('pages.landing-page.myturnamen.detail', compact('turnamen'));
    }

    public function edit($id)
    {
        $turnamen = Turnamen::findOrFail($id);
        return view('pages.landing-page.myturnamen.edit', compact('turnamen'));
    
    }

    public function update(Request $request, $id)
    {
        $turnamen = Turnamen::findOrFail($id);
        $turnamen->nama_turnamen = $request->input('nama_turnamen');
        $turnamen->update();
        return redirect('/myturnamen');
        
    }

    public function destroy(string $id)
    {
        // Menghapus jadwal pertandingan yang terhubung dengan turnamen yang akan dihapus
        Schedule::where('id_turnamenFK', $id)->delete();

        // Menghapus data klasemen yang terhubung dengan turnamen yang akan dihapus
        M_tim::where('id_turnamenFK', $id)->delete();

        // Menghapus data klasemen yang terhubung dengan turnamen yang akan dihapus
        Klasemen::where('id_turnamenFK', $id)->delete();

        // Menghapus turnamen itu sendiri
        Turnamen::destroy($id);

        return redirect()->back()->with('success', 'Turnamen dan data terkait berhasil dihapus.');
    }


}
