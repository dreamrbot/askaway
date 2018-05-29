<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class VideoController extends Controller
{

  public function index()
  {
    return view('video.upload');
  }

  public function store($filename , $base64, $id)
    {
        $video = Video::create([
            'question_id' => $id,
            'video_filename' => $filename,
        ]);
        file_put_contents(storage_path('uploads/videos/').$filename,$base64);
    }

    public function videoUpload()
    {
      return view('videoUpload');
    }

    public function videoUploadPost()
    {

      $videoName = "answer1";
      $file = Input::file('video');
      $videoData = file_get_contents($file);
      $base64 = base64_encode($videoData);
      file_put_contents(public_path('videos/').$videoName,$base64);

      return back()
                ->with('success','You have successfully uploaded a video.')
                ->with('video',$videoName);
    }

}
