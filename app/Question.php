<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Traits\Orderable;
use Illuminate\Support\Facades\DB;


class Question extends Model
{
  use Orderable;
    protected $fillable = ['title'];


    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function answers()
    {
      return $this->hasMany('App\Answer')->oldestFirst();
    }

    public function video()
    {
      return $this->hasOne('App\Videos');
    }

    public function scopeGetQuestions($query, $user)
    {
      return $query->where('user_id', $user)->limit(6);
    }

}
