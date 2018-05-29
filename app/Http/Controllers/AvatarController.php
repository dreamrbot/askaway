<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Http\Requests\StoreAvatarFormRequest;

class AvatarController extends Controller
{
    public function store(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();
      // if($request->hasFile('avatar'))
      // {
        $avatar = $request->file('avatar');
        $filename = time().'.'.rand(10,1000).'.'.$avatar->getClientOriginalExtension();
        $imageData = file_get_contents($avatar);
        // $base64 = base64_encode($imageData);
        file_put_contents(storage_path('uploads/avatars/').$filename,$imageData);
        $profile->avatar_id = $filename;
        $profile->save();
      // }
      // else{
      //   return response()->json([
      //     "error" => "avatar was not attached or not uploaded"
      //   ], 200);
      // }
    }

    public function show(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();
      $filename = $profile->avatar_id;
      return response()->json([
        'avatar' => $profile->id,
        'avatar_id' =>file_get_contents(storage_path('uploads/avatars/'.$filename)),
      ]);

    }

    public function edit(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();

      // if($request->hasFile('avatar'))
      // {
        $avatar = $request->file('avatar');
        $filename = time().'.'.rand(10,1000).'.'.$avatar->getClientOriginalExtension();
        $imageData = file_get_contents($avatar);
      //  $base64 = base64_encode($imageData);
        file_put_contents(storage_path('uploads/avatars/').$filename,$imageData);
        // unlink(storage_path('uploads/videos/'.$profile->avatar_id));
        $profile->avatar_id = $filename;
        $profile->save();
      // }
      // else{
      //   return response()->json([
      //     "message" => "avatar was not attached or not uploaded"
      //   ], 200);
      // }
    }

    public function destroy(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();
      if($profile->avatar_id != null)
      {
        $filename = $profile->avatar_id;
        unlink(storage_path('uploads/videos/'.$filename));
        $profile->avatar_id = null;
        $profile->save();

        return response()->json([
          "message" => "avatar was deleted"
        ], 200);
      }
      return response()->json([
        "message" => "there was no avatar "
      ], 200);
    }
}
