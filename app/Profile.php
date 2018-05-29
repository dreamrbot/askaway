<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
  protected $fillable = [
    'Gender', 'country', 'year_of_birth', 'score',
  ];
    public function user()
    {
      return $this->belongsTo('App\User');
    }


}
