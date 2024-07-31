<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\M_tim;
use App\Models\Klasemen;
use App\Models\Turnamen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ScheduleController extends Controller
{

    public function index($id_turnamenFK)
    {
        $schedule = Schedule::where('id_turnamenFK', $id_turnamenFK)->get();
        $klasemen = Klasemen::all();
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        return view('pages.landing-page.schedule.index', compact('schedule', 'klasemen', 'turnamen'));
    }

    public function view($id_turnamenFK)
    {
        $schedule = Schedule::where('id_turnamenFK', $id_turnamenFK)->get();
        $klasemen = Klasemen::all();
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        return view('pages.landing-page.schedule.view', compact('schedule', 'klasemen', 'turnamen'));
    }

    public function generateSchedule(Request $request)
    {
        $selectedTeams = $request->input('selected_teams');
        $id_turnamenFK = $request->input('id_turnamenFK');
    
        if (empty($selectedTeams) || count($selectedTeams) < 2) {
            return redirect()->back()->withErrors(['message' => 'Minimal harus ada 2 tim untuk menggenerate jadwal.']);
        }
    
    
        // Validasi tim
        $teamsCount = M_tim::whereIn('id', $selectedTeams)->count();
        if ($teamsCount < 2) {
            abort(400, 'At least two team names are required.');
        }
    
        // Menentukan jumlah tim
        $jumlah_tim = count($selectedTeams);
    
        // Mengecek jika tim berjumlah ganjil, membuat tim tiruan
        if ($jumlah_tim % 2 != 0) {
            $selectedTeams[] = 'dummy'; // Tambahkan ID tim tiruan
            $jumlah_tim++;
        }
    
        // Membuat array schedule
        $schedule = [];
    
        // Generate the schedule
        for ($round = 1; $round <= $jumlah_tim - 1; $round++) {
            echo "Round $round: ";
            for ($i = 0; $i < $jumlah_tim / 2; $i++) {
                $team1 = $selectedTeams[$i];
                $team2 = $selectedTeams[$jumlah_tim - $i - 1];
                if ($team1 != 'dummy' && $team2 != 'dummy') {
                    // Simpan jadwal pertandingan pertama
                    $schedule[] = [
                        'id_turnamenFK' => $id_turnamenFK,
                        'home_team' => $team1,
                        'away_team' => $team2,
                        'round_number' => $round,
                    ];
                    
                    echo "$team1 vs $team2 ";
                }
            }
            echo "\n";
    
            // Rotate the teams
            $last_team = array_pop($selectedTeams);
            array_splice($selectedTeams, 1, 0, $last_team);
    
            // Generate the second round of matches (tukar home-away)
            for ($i = 0; $i < $jumlah_tim / 2; $i++) {
                $team1 = $selectedTeams[$i];
                $team2 = $selectedTeams[$jumlah_tim - $i - 1];
                if ($team1 != 'dummy' && $team2 != 'dummy') {
                    // Simpan jadwal pertandingan kedua
                    $schedule[] = [
                        'id_turnamenFK' => $id_turnamenFK,
                        'home_team' => $team2, // Tukar home-away
                        'away_team' => $team1,
                        'round_number' => $round + $jumlah_tim - 1, // Nomor round ditambah jumlah_tim - 1
                    ];
                    
                    echo "$team2 vs $team1 ";
                }
            }
            echo "\n";
    
            // Rotate the teams again for the next round
            $last_team = array_pop($selectedTeams);
            array_splice($selectedTeams, 1, 0, $last_team);
        }
    
        // Hapus tim tiruan dari jadwal jika ditambahkan
        if ($jumlah_tim % 2 != 0) {
            array_pop($schedule);
        }
        
        $startDate = $request->input('start_date');
        
        // Memanggil fungsi setMatchDate untuk menetapkan tanggal pertandingan
        $schedule = $this->setMatchDate($schedule, $startDate);

        // Menyimpan data schedule ke dalam database
        foreach ($schedule as $match) {
            Schedule::create($match);
        }
    
        // Menyimpan data ID tim ke dalam tabel klasemen
        $selectedTeams = $request->input('selected_teams');
        foreach ($selectedTeams as $teamId) {
            // Periksa apakah tim sudah ada di tabel klasemen
            $existingTeam = Klasemen::where('id_timFK', $teamId)->first();
            if ($existingTeam) {
                // Jika tim sudah ada tidak akan membuat data duplicate
            } else {
                // Jika tim belum ada, buat data baru dalam tabel klasemen
                Klasemen::create([
                    'id_timFK' => $teamId,
                    'id_turnamenFK' => $id_turnamenFK,
                ]);
            }
        }
 
        return redirect()->route('schedule.index', ['id_turnamenFK' => $id_turnamenFK])->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // public function setMatchDate($schedule, $startDate)
    // {
    //     $matchesPerWeek = count($schedule) / 4; // Setiap minggu akan ada seperempat jumlah pertandingan
    //     $matchesPerSaturday = 5; // Batasan jumlah pertandingan pada hari Sabtu
    //     $startDateTime = Carbon::parse($startDate)->next(Carbon::SATURDAY)->setTime(16, 0); // Set ke Sabtu berikutnya pukul 16:00
    
    //     $matchDateTime = $startDateTime;
    //     $matchCount = 0;
    //     $saturdayMatchCount = 0;
    //     $weekMatchedTeams = [];
    
    //     foreach ($schedule as $key => $match) {
    //         $homeTeam = $match['home_team'];
    //         $awayTeam = $match['away_team'];
    
    //         // Cek apakah salah satu tim sudah bermain pada minggu ini
    //         if (in_array($homeTeam, $weekMatchedTeams) || in_array($awayTeam, $weekMatchedTeams)) {
    //             // Jika sudah bermain, lanjutkan ke minggu berikutnya
    //             $matchDateTime->addWeek();
    //             $matchDateTime->setTime(16, 0); // Kembali ke Sabtu pukul 16:00
    //             $matchCount = 0;
    //             $saturdayMatchCount = 0;
    //             $weekMatchedTeams = []; // Reset tim yang sudah bermain
    //         }
    
    //         $schedule[$key]['match_date'] = $matchDateTime->copy();
    
    //         // Tambahkan pertandingan ke tim yang sudah bermain pada minggu ini
    //         $weekMatchedTeams[] = $homeTeam;
    //         $weekMatchedTeams[] = $awayTeam;
    
    //         // Hitung jumlah pertandingan pada hari Sabtu
    //         if ($matchDateTime->isSaturday()) {
    //             $saturdayMatchCount++;
    //         }
    
    //         $matchCount++;
    
    //         // Jika sudah mencapai jumlah pertandingan per minggu atau jumlah pertandingan pada hari Sabtu telah mencapai batas
    //         if ($matchCount == $matchesPerWeek || $saturdayMatchCount == $matchesPerSaturday) {
    //             // Pindah ke minggu berikutnya
    //             $matchDateTime->addWeek();
    //             // Reset jumlah pertandingan
    //             $matchCount = 0;
    //             $saturdayMatchCount = 0;
    //             // Pindah ke Sabtu pada pukul 16:00
    //             $matchDateTime->next(Carbon::SATURDAY)->setTime(16, 0);
    //         } else {
    //             // Jika sudah ada pertandingan pada jam 16:00, atur untuk berikutnya pada jam 20:00
    //             if ($matchDateTime->hour == 16) {
    //                 $matchDateTime->addHours(4);
    //             } else {
    //                 // Jika sudah ada pertandingan pada jam 20:00, pindah ke hari berikutnya pada pukul 16:00
    //                 $matchDateTime->addDay()->setTime(16, 0);
    //             }
    //         }
    //     }
    
    //     return $schedule;
    // }

    public function setMatchDate($schedule, $startDate)
    {
        $matchesPerWeek = 14; // Batasan jumlah pertandingan per minggu
        $startDateTime = Carbon::parse($startDate)->setTime(16, 0); // Mengatur tanggal dan waktu mulai pertandingan
    
        $matchDateTime = $startDateTime;
        $matchCount = 0;
        $dailyMatchCount = 0;
        $weekMatchedTeams = [];
    
        foreach ($schedule as $key => $match) {
            $homeTeam = $match['home_team'];
            $awayTeam = $match['away_team'];
    
            // Cek apakah salah satu tim sudah bermain pada minggu ini
            if (in_array($homeTeam, $weekMatchedTeams) || in_array($awayTeam, $weekMatchedTeams)) {
                // Jika sudah bermain, lanjutkan ke minggu berikutnya
                $matchDateTime->addWeek();
                $matchDateTime->setTime(16, 0); // Kembali ke pukul 16:00
                $matchCount = 0;
                $dailyMatchCount = 0;
                $weekMatchedTeams = []; // Reset tim yang sudah bermain
            }
    
            $schedule[$key]['match_date'] = $matchDateTime->copy();
    
            // Tambahkan pertandingan ke tim yang sudah bermain pada minggu ini
            $weekMatchedTeams[] = $homeTeam;
            $weekMatchedTeams[] = $awayTeam;
    
            $dailyMatchCount++;
    
            // Jika sudah mencapai jumlah pertandingan per hari atau sudah mencapai batas minggu
            if ($dailyMatchCount == $matchesPerWeek || $matchDateTime->isSunday()) {
                // Pindah ke hari berikutnya
                $matchDateTime->addWeek();
                // Reset jumlah pertandingan harian
                $dailyMatchCount = 0;
                // Kembali ke pukul 16:00
                $matchDateTime->setTime(16, 0);
            } else {
                // Jika sudah ada pertandingan pada jam 16:00, atur untuk berikutnya pada jam 20:00
                if ($matchDateTime->hour == 16) {
                    $matchDateTime->addHours(4);
                } else {
                    // Jika sudah ada pertandingan pada jam 20:00, pindah ke hari berikutnya pada pukul 16:00
                    $matchDateTime->addDay()->setTime(16, 0);
                }
            }
        }
    
        return $schedule;
    }
    

        

     
    /**
     * Show the form for creating a new resource.
     */
    public function create($id_turnamenFK)
    {
        $tim = M_tim::where('id_turnamenFK', $id_turnamenFK)->get();
        $schedule = Schedule::all();
        $turnamen = Turnamen::findOrFail($id_turnamenFK);
        return view('pages.landing-page.schedule.create', compact('schedule', 'tim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('pages.landing-page.schedule.update', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mengambil data schedule berdasarkan ID
        $schedule = Schedule::findOrFail($id);
        $schedule->gol_home = $request->input('gol_home');
        $schedule->gol_away = $request->input('gol_away');
        $schedule->match_date = $request->input('match_date');

        // Perolehan Point
        if ($schedule->gol_home > $schedule->gol_away) {
            $schedule->main_home = 1;
            $schedule->menang_home = 1;
            $schedule->imbang_home = 0;
            $schedule->kalah_home = 0;
            $schedule->main_away = 1;
            $schedule->menang_away = 0;
            $schedule->imbang_away = 0;
            $schedule->kalah_away = 1;
        } elseif ($schedule->gol_home < $schedule->gol_away) {
            $schedule->main_away = 1;
            $schedule->menang_away = 1;
            $schedule->imbang_away = 0;
            $schedule->kalah_away = 0;
            $schedule->main_home = 1;
            $schedule->menang_home = 0;
            $schedule->imbang_home = 0;
            $schedule->kalah_home = 1;
        }else{
            $schedule->main_home = 1;
            $schedule->menang_home = 0;
            $schedule->imbang_home = 1;
            $schedule->kalah_home = 0;
            $schedule->main_away = 1;
            $schedule->menang_away = 0;
            $schedule->imbang_away = 1;
            $schedule->kalah_away = 0;
        }
        
        $schedule->update();

        // Panggil fungsi updateKlasemen
        $this->updateKlasemen($request, $id);
        return redirect()->route('schedule.index', ['id_turnamenFK' => $schedule->id_turnamenFK])->with('success', 'Jadwal berhasil ditambahkan.');

    }

    public function updateKlasemen(Request $request, string $id)
    {
        // Mengambil data schedule berdasarkan ID
        $schedule = Schedule::findOrFail($id);
    
        // Mengambil data tim berdasarkan home_team dan away_team
        $homeTeam = Klasemen::where('id_timFK', $schedule->home_team)->first();
        $awayTeam = Klasemen::where('id_timFK', $schedule->away_team)->first();
    
        // Mengambil statistik tim pada Seluruh Pertandingan
        $homeMatches = Schedule::where('home_team', $homeTeam->id_timFK)
                                ->orWhere('away_team', $homeTeam->id_timFK)
                                ->get();
    
        $awayMatches = Schedule::where('away_team', $awayTeam->id_timFK)
                                ->orWhere('home_team', $awayTeam->id_timFK)
                                ->get();
    
        // Menghitung statistik untuk home_team
        $homeMain = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('main_home') +
                    $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('main_away');
    
        $homeMenang = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('menang_home') +
                      $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('menang_away');
    
        $homeImbang = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('imbang_home') +
                      $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('imbang_away');
    
        $homeKalah = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('kalah_home') +
                     $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('kalah_away');
    
        $homeGol = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('gol_home') +
                   $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('gol_away');
    
        $homeKebobolan = $homeMatches->where('home_team', $homeTeam->id_timFK)->sum('gol_away') +
                         $homeMatches->where('away_team', $homeTeam->id_timFK)->sum('gol_home');
    
        $homeSelisihGol = $homeGol - $homeKebobolan;
    
        $homePoint = $homeMenang * 3 + $homeImbang; // Hitung total poin untuk home_team
    
        // Menghitung statistik untuk away_team
        $awayMain = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('main_home') +
                    $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('main_away');
    
        $awayMenang = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('menang_home') +
                      $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('menang_away');
    
        $awayImbang = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('imbang_home') +
                      $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('imbang_away');
    
        $awayKalah = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('kalah_home') +
                     $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('kalah_away');
    
        $awayGol = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('gol_home') +
                   $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('gol_away');
    
        $awayKebobolan = $awayMatches->where('home_team', $awayTeam->id_timFK)->sum('gol_away') +
                         $awayMatches->where('away_team', $awayTeam->id_timFK)->sum('gol_home');
    
        $awaySelisihGol = $awayGol - $awayKebobolan;
    
        $awayPoint = $awayMenang * 3 + $awayImbang; // Hitung total poin untuk away_team
    
        // Update data klasemen untuk home_team
        $homeTeam->update([
            'main' => $homeMain,
            'menang' => $homeMenang,
            'imbang' => $homeImbang,
            'kalah' => $homeKalah,
            'gol' => $homeGol,
            'kebobolan' => $homeKebobolan,
            'selisih_gol' => $homeSelisihGol,
            'point' => $homePoint,
        ]);
    
        // Update data klasemen untuk away_team
        $awayTeam->update([
            'main' => $awayMain,
            'menang' => $awayMenang,
            'imbang' => $awayImbang,
            'kalah' => $awayKalah,
            'gol' => $awayGol,
            'kebobolan' => $awayKebobolan,
            'selisih_gol' => $awaySelisihGol,
            'point' => $awayPoint,
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
