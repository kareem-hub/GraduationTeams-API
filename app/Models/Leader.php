<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Leader extends Model
{
    use HasFactory, HasApiTokens;

    public function team()
    {
        $this->hasOne(Team::class);
    }

    protected $fillable = [
        'username',
        'name',
        'password',
    ];

    public $timestamps = false;
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';
}
