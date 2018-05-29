<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\User;
use App\Events\Auth\UserRequestedActivationEmail;
use App\Transformers\UserTransformer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use AuthenticatesUsers;

    public function register(StoreUserRequest $request)
    {
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->api = true;


      $success = $user->save();

      if( $success = true)
      {
        event(new UserRequestedActivationEmail($user));
      }

      return fractal()->item($user)->transformWith(new UserTransformer)->toArray();

    }

    

}
