<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;

class ActivationController extends Controller
{
    public function activate(Request $request)
    {
      $user = User::byActivationColumns($request->email,$request->token)->firstOrFail();

      $user->update([
        'active' => true,
        'activation_token' =>null,
      ]);


      if($user->role == true)
      {
        $role = Role::where('name', '=', 'User')->first();
        $user->attachRole($role);
      }
      else{
        $role = Role::where('name', '=', 'business_user')->first();
        $user->attachRole($role);
      }


      if($user->hasRole('businessuser')){
        Auth::loginUsingId($user->id);
        return redirect()->route('home.dashboard')->withSuccess('Activated! you are now signed in');
      }
      else{// might not work
        return response()->json([
                          'activated' => 'true',
                        ]);
      }

    }
}
