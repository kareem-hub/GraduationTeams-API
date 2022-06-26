<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function leader()
    {
        return $this->belongsTo(Leader::class, 'leader_id', 'username');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'team_id', 'id');
    }

    protected $fillable = [
        'leader_id',
        'needs'
    ];

    public $timestamps = false;
    // protected $primaryKey = "leader_id";
    // public $incrementing = false;
    // protected $keyType = 'string';
}
