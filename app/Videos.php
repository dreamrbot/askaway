<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;

class Videos extends Model
{
  use SoftDeletes, Orderable;

    protected $fillable = [
        'question_id',
        'answer_id',
        'description',
        'video_filename',
        'video_id',
        'processed_percentage',
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }

    public function processedPercentage()
    {
        return $this->processed_percentage;
    }

    public function scopeProcessed($query)
    {
        return $query->where('processed', true);
    }

}
