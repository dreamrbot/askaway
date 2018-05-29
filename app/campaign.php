<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
  protected $fillable = [
    'credit_limit', 'response_limit', 'demograph', 'tax_number', 'phone_number',
  ];
  public function business_account()
  {
    return $this->belongsTo('App\business_account');
  }

  public function question()
  {
    return $this->hasOne('App\Question');
  }
}
