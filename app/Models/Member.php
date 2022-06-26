<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function team()
    {
        $this->belongsTo(Team::class);
    }

    protected $fillable = [
        'team_id',
        'name',
        'department',
        'major'
    ];

    public $timestamps = false;
    protected $primaryKey = "team_id";
    public $incrementing = false;
    // protected $keyType = 'int';
}
