<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SegmentJudgeSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['segment_id', 'user_id', 'submitted_at'];

    public function segment() { return $this->belongsTo(Segment::class); }
    public function judge() { return $this->belongsTo(User::class, 'user_id'); }
}
