<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $fillable = [
        'id_turnamenFK',
        'home_team',
        'away_team',
        'round_number',
        'created_at',
        'updated_at',
        'gol_home',
        'main_home',
        'menang_home',
        'imbang_home',
        'kalah_home',
        'point_home',
        'gol_away',
        'main_away',
        'menang_away',
        'imbang_away',
        'kalah_away',
        'point_away',
        'match_date',
    ];


    public function homeTeam()
    {
        return $this->belongsTo(M_tim::class, 'home_team');
    }

    public function awayTeam()
    {
        return $this->belongsTo(M_tim::class, 'away_team');
    }
}
