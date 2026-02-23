<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SegmentCriterion extends Model
{
    use HasFactory;

    protected $table = 'segment_criteria';

    protected $fillable = [
        'segment_id',
        'name',
        'display_order',
    ];

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }
}
