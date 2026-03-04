<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;

    

    protected $fillable = [
    'name',
    'display_order',
    'gender_scope',
    'is_final',
    'is_open',
    'is_locked',
    'visible_to_judges',
];
public function criteria()
{
    return $this->hasMany(\App\Models\SegmentCriterion::class)->orderBy('display_order');
}

public function criterionScores()
{
    return $this->hasMany(\App\Models\CriterionScore::class);
}

public function judgeSubmissions()
{
    return $this->hasMany(SegmentJudgeSubmission::class);
}
}
