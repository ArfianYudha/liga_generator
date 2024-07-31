<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_tim;
use App\Models\Turnamen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class TimController extends Controller
{
    // public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function index($id_turnamenFK)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $tim = M_tim::where('id_turnamenFK', $id_turnamenFK)->get();
        return view('pages.landing-page.tim.index', compact('tim','turnamen'));
    }

    
    public function team($id_turnamenFK)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $tim = M_tim::where('id_turnamenFK', $id_turnamenFK)->get();
        return view('pages.landing-page.tim.view', compact('tim','turnamen'));
    }

    public function create($id_turnamenFK)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $tim = M_tim::where('id_turnamenFK', $id_turnamenFK)->first();
        return view('pages.landing-page.tim.create', compact('tim','turnamen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tim' => 'required',
            'stadion' => 'required',
            'id_turnamenFK' => 'required|exists:turnamen,id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai kebutuhan Anda
        ]);

        $tim = new M_tim();
        $tim->nama_tim = $request->input('nama_tim');
        $tim->stadion = $request->input('stadion');
        $tim->id_turnamenFK = $request->input('id_turnamenFK');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('picture/logo/'), $imageName);
        
            // Simpan nama gambar ke dalam database
            $tim->gambar = $imageName;
        }

        $tim->save();

        return redirect()->route('tim.index', ['id_turnamenFK' => $tim->id_turnamenFK])->with('success', 'Tim berhasil ditambahkan.');
    }

    public function edit($id_turnamenFK ,$id)
    {
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        $tim = M_tim::findOrFail($id);
        return view('pages.landing-page.tim.edit', compact('tim','turnamen'));
    
    }

    public function update(Request $request, $id)
    {
        $tim = M_tim::findOrFail($id);
        $tim->nama_tim = $request->input('nama_tim');
        $tim->stadion = $request->input('stadion');
        $tim->id_turnamenFK = $request->input('id_turnamenFK');

        if ($request->hasFile('gambar')) {
            // Hapus gambar Lama jika ada 

            if ($tim->gambar && file_exists(public_path('picture/logo/' . $tim->gambar))) {
                unlink(public_path('picture/logo/' . $tim->gambar));
            }
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('picture/logo/'), $imageName);
        
            // Simpan nama gambar ke dalam database
            $tim->gambar = $imageName;
        }

        $tim->update();
        return redirect()->route('tim.index', ['id_turnamenFK' => $tim->id_turnamenFK])->with('success', 'Tim berhasil diubah.');

    }

    public function destroy($id)
    {
        $tim = M_tim::findOrFail($id);
        if ($tim->gambar && file_exists(public_path('picture/logo/' . $tim->gambar))) {
            unlink(public_path('picture/logo/' . $tim->gambar));
        }
        $tim->delete();
        return redirect()->route('tim.index', ['id_turnamenFK' => $tim->id_turnamenFK])->with('success','Tim berhasil dihapus.');
    }
}