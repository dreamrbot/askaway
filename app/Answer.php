<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Traits\Orderable;

class Answer extends Model
{
  use Orderable;
    protected $fillable = ['title','score'];


    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function question()
    {
      return $this->belongsTo('App\Question');
    }
    
    public function video()
    {
      return $this->hasOne('App\Videos');
    }
}
