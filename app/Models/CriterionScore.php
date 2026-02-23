<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CriterionScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'contestant_id',
        'segment_id',
        'criterion_id',
        'user_id',
        'score',
    ];

    public function contestant() { return $this->belongsTo(Contestant::class); }
    public function segment() { return $this->belongsTo(Segment::class); }
    public function criterion() { return $this->belongsTo(SegmentCriterion::class, 'criterion_id'); }
    public function judge() { return $this->belongsTo(User::class, 'user_id'); }
}
