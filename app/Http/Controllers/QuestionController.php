<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Videos;
use App\Http\Requests\StoreQuestionRequest;
use App\Transformers\QuestionTransformer;
use Illuminate\Support\Facades\DB;



class QuestionController extends Controller

{

  public function index(Request $request)
  {
    $questions = $request->user()->questions()->get();

    return fractal()->collection($questions)->parseIncludes(['user', 'answers', 'answers.user','answers.user.profile'])->transformWith(new QuestionTransformer)->toArray();
  }


    public function store(StoreQuestionRequest $request)
    {
      $question = new Question;
      $question->user()->associate($request->user());
      $user = $question->user()->first();
      $user_profile = $user->profile()->first();
      $questions_count = $user->questions()->get();

      $questions_count = $questions_count->count();
      $user_profile->questions_count = $questions_count;

      // if($request->hasFile('video'))
      // {
        $video = $request->file('video');
        $filename = time().'.'.rand(10,1000).'.'.$video->getClientOriginalExtension();
        $videoData = file_get_contents($video);
        // $base64 = base64_encode($videoData);
        file_put_contents(storage_path('uploads/videos/').$filename,$videoData);

        $question->save();
        $videoStore = new Videos;

        $videoStore->question()->associate($question);
        $videoStore->video_filename = $filename;
        $question->video()->save($videoStore);
        $question->video_id = $videoStore->id;
        $question->save();
        $user_profile->save();

        return fractal()->item($question)
        ->parseIncludes(['user'])
        ->transformWith(new QuestionTransformer)->toArray();
      // }
      // else{
      //   return response()->json([
      //     "error" => "video was not attached or not uploaded"
      //   ], 200);
      // }

    }

    public function show($id)
    {
      $question = Question::findorFail($id);
      $video = $question->video()->get();
      $filename = $video->pluck('video_filename')->first();
      str_replace('"', "",$filename);

      return response()->json([
        'video' => $video,
        'video_file' => file_get_contents(storage_path('uploads/videos/'.$filename)),
      ]);
    }

    public function getQuestions(Request $request)
    {
      $questions = Question::where('user_id','!=', $request->user()->id)->get();
        return fractal()->collection($questions)
        ->parseIncludes(['user', 'user.profile'])
        ->transformWith(new QuestionTransformer)->toArray();
    }

    public function destroy($id)
    {
      $question = Question::findorFail($id);
      $video = $question->video()->get();
      $filename = $video->pluck('video_filename')->first();
      str_replace('"', "",$filename);

      unlink(storage_path('uploads/videos/'.$filename));
      $question->delete();
    }

}
