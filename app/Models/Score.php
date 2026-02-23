<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'contestant_id',
        'segment_id',
        'user_id',
        'score',
    ];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
