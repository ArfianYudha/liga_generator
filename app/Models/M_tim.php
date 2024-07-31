<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_tim extends Model
{
    use HasFactory;
    protected $table = 'tim';

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'home_team')->orWhere('away_team', $this->id);
    }
}

