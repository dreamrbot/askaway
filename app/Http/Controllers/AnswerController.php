<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User;
use App\Profile;
use App\Videos;
use App\Http\Requests\StoreAnswerScoreRequest;
use App\Http\Requests\StoreAnswerRequest;
use App\Transformers\AnswerTransformer;


class AnswerController extends Controller
{

  public function index(Request $request)
  {
      $answer = $request->user()->answers()->get();

      return fractal()->collection($answer)
      ->transformWith(new AnswerTransformer)->toArray();

  }
  public function store(StoreAnswerRequest $request, Question $question)
  {
    $answer = new Answer;

    $answer->user()->associate($request->user());

    $user = $answer->user()->first();
    $user_profile = $user->profile()->first();
    $answers_count = $user->answers()->get();

    $answers_count = $answers_count->count();
    $user_profile->answers_count = $answers_count;
    $user_profile->save();
    $question->answers()->save($answer);

    // if($request->hasFile('video'))
    // {
      $video = $request->file('video');
      $filename = time().'.'.rand(10,1000).'.'.$video->getClientOriginalExtension();
      $videoData = file_get_contents($video);
      // $base64 = base64_encode($videoData);
      file_put_contents(storage_path('uploads/videos/').$filename,$videoData);

      $answer->save();
      $videoStore = new Videos;

      $videoStore->answer()->associate($answer);
      $videoStore->video_filename = $filename;
      $answer->video()->save($videoStore);
      $answer->video_id = $videoStore->id;
      $answer->save();


      return fractal()->item($answer)
      ->parseIncludes(['user', 'user.profile'])
      ->transformWith(new AnswerTransformer)->toArray();
    // }
    // else{
    //   return response()->json([
    //     "error" => "video was not attached or not uploaded"
    //   ], 200);
    // }
  }

  public function show($id)
  {
    $answer = Answer::findorFail($id);
    $video = $answer->video()->get();
    $filename = $video->pluck('video_filename')->first();
    str_replace('"', "",$filename);

    return response()->json([
      'video' => $video,
      'video_file' =>file_get_contents(storage_path('uploads/videos/'.$filename)),
    ]);
  }

  public function destroy($id)
  {
    $answer = Answer::findorFail($id);
    $video = $answer->video()->get();
    $filename = $video->pluck('video_filename')->first();
    str_replace('"', "",$filename);

    unlink(storage_path('uploads/videos/'.$filename));
    $answer->delete();

    return response()->json([
      'message' => 'Answer was deleted',
    ]);
  }

  public function updateScore(StoreAnswerScoreRequest $request, Question $question, Answer $answer)
  {
    $answer->score = $request->score;
    $user = $answer->user()->first();
    $user_profile = $user->profile()->first();

    $scoring_user = $request->user()->profile()->first();
    $scoring_user->given_scores_count = $scoring_user->given_scores_count + 1;
    $scoring_user->avg_given_score = $this->avgScore($scoring_user->avg_given_score, $scoring_user->given_scores_count,$request->score);

    $user_profile->max_score = $this->maxScore($user_profile->max_score, $answer->score);
    $user_profile->min_score = $this->minScore($user_profile->min_score, $answer->score);
    $deviation               = $this->scoreDeviation($user_profile->score, $answer->score);
    $user_profile->score     = $this->avgScore($user_profile->score, $user->answers()->count(), $deviation);

    $scoring_user->save();
    $user_profile->save();
    $answer->save();
  }

  protected function scoreDeviation($current_score, $new_score)
  {
    $max_deviation = 2;
    $score;
    if($new_score > $current_score + $max_deviation)
    {
      $score = $current_score + $max_deviation;
    }
    elseif($new_score < $current_score - $max_deviation)
    {
      $score = $current_score - $max_deviation;
    }
    else
    {
      $score = $new_score;
    }

    return $score;
  }

  protected function avgScore($current_avg, $answer_count, $new_score)
  {
    $new_average = (($current_avg * $answer_count) + $new_score) / ($answer_count + 1);

    return $new_average;
  }

  protected function minScore($currentScore, $newScore)
  {
    $min_score = $currentScore;
    if($min_score != 0)
    {
      $min_score = min($newScore ,$min_score);
    }
    else {
      $min_score = $newScore ;
    }
    return $min_score;
  }

  protected function maxScore($currentScore, $newScore)
  {
    $score = max($currentScore, $newScore);

    return $score;
  }


}
