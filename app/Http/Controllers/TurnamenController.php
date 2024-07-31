<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turnamen;
use App\Models\M_tim;
use App\Models\Klasemen;
use App\Models\Schedule;
class TurnamenController extends Controller
{
    public function index()
    {
        $turnamen = Turnamen::orderBy('created_at', 'desc')->get();
        return view('pages.landing-page.turnamen.index', compact('turnamen'));
    }

    public function detail_turnamen($id)
    {
        $turnamen = Turnamen::findOrFail($id);
        return view('pages.landing-page.turnamen.detail', compact('turnamen'));
    }

    public function create()
    {
        $turnamen = Turnamen::all();
        return view('pages.landing-page.turnamen.create', compact('turnamen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_turnamen' => 'required',
        ]);

        $turnamen = new Turnamen();
        $turnamen->nama_turnamen = $request->input('nama_turnamen');
        $turnamen->id_users = auth()->id();
        $turnamen->save();

        return redirect('/turnamen')->with('success', 'Turnamen berhasil ditambahkan.');
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
