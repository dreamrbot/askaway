<?php

namespace App\Transformers;

use App\Profile;

class ProfileTransformer extends \League\Fractal\TransformerAbstract
{
  protected $availableIncludes = ['user'];

  public function transform(Profile $profile)
  {
    return
    [
      'id' => $profile->id,
      'Gender' => $profile->Gender,
      'country' => $profile->country,
      'year_of_birth' => $profile->year_of_birth,
      'created_at' => $profile->created_at->toDateTimeString(),
      'created_at_human' => $profile->created_at->diffForHumans(),
      'user' => $profile->user_id,
      'score' => $profile->score,
      // 'avatar_file' => $profile->avatar_id,
      'avatar_file' => file_get_contents(storage_path('uploads/avatars/'.$profile->avatar_id)),


    ];
  }

  public function includeUser(Profile $profile)
  {
    return $this->item($profile->user, new UserTransformer);
  }

  public function includeUAvatar(Profile $profile)
  {
    return $this->item($profile->user, new UserTransformer);
  }

}
 ?>
