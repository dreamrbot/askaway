<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProfileRequest;
use App\Profile;
use App\User;
use App\Answers;
use App\Transformers\ProfileTransformer;
use App\Http\Requests\UpdateProfileRequest;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;


class ProfileController extends Controller
{
    public function store(StoreProfileRequest $request)
    {
      $profile = new Profile;
      $profile->Gender = $request->Gender;
      $profile->country = $request->country;
      $profile->year_of_birth = $request->year_of_birth;
      $profile->user()->associate($request->user());
      $profile->save();


      return fractal()->item($profile)->parseIncludes(['user'])->transformWith(new ProfileTransformer)->toArray();

    }

    public function show(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();

      $v = $request->user()->answers()->where('created_at', '>', Carbon::now()->subDays(7)->toDateTimeString())->get(['score'])->toArray();
      $profile->avg_score_7_days = $this->avg_7_day_score($v);
      $profile->save();


      return fractal()
      ->item($profile )
      ->parseIncludes(['user'])
      ->transformWith(new ProfileTransformer)
      ->toArray();
    }

    public function edit(UpdateProfileRequest $request, User $user, Profile $profile)
    {
      $profile = $request->user()->profile()->first();
      $profile->country = $request->country;
      $profile->year_of_birth = $request->year_of_birth;
      $profile->Gender = $request->Gender;


      $profile->save();

      return fractal()
      ->item($profile, 'profile')
      ->parseIncludes(['user'])
      ->transformWith(new ProfileTransformer)
      ->toArray();

    }

    protected function avg_7_day_score(Array $array)
    {
      $total = 0;
      $count = 0;
      foreach ($array as $key => $value)
      {
        foreach($value as $answer => $score)
        {
          if(!empty($score))
          {
            $total =$total + $score;
            $count++;
          }
        }
      }

      if($count != 0)
      {
        $average = $total / $count;
      }
      $average = 0;

      return $average;
    }

}
