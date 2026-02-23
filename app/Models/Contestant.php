<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'number',
    ];
    public function scores()
{
    return $this->hasMany(\App\Models\Score::class);
}

}


