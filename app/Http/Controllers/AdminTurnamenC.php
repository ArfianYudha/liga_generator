<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;
use App\Models\M_tim;
use App\Models\Klasemen;
use App\Models\Schedule;

class AdminTurnamenC extends Controller
{
    public function view()
    {
        $turnamen = Turnamen::all();
        return view('pages.admin.turnamen.index', compact('turnamen'));
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
