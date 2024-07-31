<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\M_tim;
use App\Models\Klasemen;
use App\Models\Turnamen;
use Illuminate\Http\Request;

class KlasemenController extends Controller
{
    public function index($id_turnamenFK)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $klasemen = Klasemen::where('id_turnamenFK', $id_turnamenFK)
        ->orderByDesc('point') // Urutkan berdasarkan poin terbanyak secara menurun
        ->orderByDesc('selisih_gol') // Jika poin sama, urutkan berdasarkan selisih gol tertinggi secara menurun
        ->get();

        return view('pages.landing-page.klasemen.index', compact('klasemen','turnamen'));
    }

    public function view($id_turnamenFK)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $klasemen = Klasemen::where('id_turnamenFK', $id_turnamenFK)
        ->orderByDesc('point') // Urutkan berdasarkan poin terbanyak secara menurun
        ->orderByDesc('selisih_gol') // Jika poin sama, urutkan berdasarkan selisih gol tertinggi secara menurun
        ->get();

        return view('pages.landing-page.klasemen.view', compact('klasemen','turnamen'));
    }

}
