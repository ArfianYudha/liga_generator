<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasemen extends Model
{
    use HasFactory;

    protected $table = 'klasemen';
    protected $fillable = [
        'id_timFK',
        'id_turnamenFK',
        'main',
        'menang',
        'imbang',
        'kalah',
        'gol',
        'kebobolan',
        'selisih_gol',
        'point',
    ];

    public function getSelisihGolAttribute()
    {
        return $this->gol - $this->kebobolan;
    }
    
    public function tim()
    {
        return $this->belongsTo(M_tim::class, 'id_timFK');
    }
}
