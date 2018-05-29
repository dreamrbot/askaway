<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Passport\HasApiTokens;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function scopeByActivationColumns(Builder $builder, $email, $token)
    {
      return $builder->where('email', $email)->where('activation_token', $token);
    }

    public function scopeByEmail(Builder $builder, $email)
    {
      return $builder->where('email', $email);
    }

    public function ownsQuestion(Question $question)
    {
      return $this->id === $question->user->id;
    }

    public function ownsAnswer(Answer $answers)
    {
      return $this->id === $answers->user->id;
    }
    public function questions()
      {
        return $this->hasMany('App\Question');
      }
    public function answers()
      {
        return $this->hasMany('App\Answer');
      }

    public function profile()
    {
      return $this->hasOne('App\Profile');
    }
    public function OauthAcessToken()
    {
      return $this->hasMany('App\OauthAccessToken');
    }



}
