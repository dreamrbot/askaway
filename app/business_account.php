<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class business_account extends Model
{
  protected $fillable = [
    'name', 'address', 'country', 'tax_number', 'phone_number',
  ];
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function campaigns()
    {
      return $this->hasMany('App\Campaign');
    }
}
