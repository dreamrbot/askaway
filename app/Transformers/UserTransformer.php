<?php

namespace App\Transformers;
use App\User;

class UserTransformer extends \League\Fractal\TransformerAbstract
{
  protected $availableIncludes = ['profile'];
  public function transform(User $user)
  {
    return[
      'name' => $user->name,
      


    ];
  }
  public function includeProfile(User $user)
  {
    return $this->item($user->profile, new ProfileTransformer);
  }
}
 ?>
