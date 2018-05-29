<?php

namespace App\Transformers;

use App\Answer;

class AnswerTransformer extends \League\Fractal\TransformerAbstract
{
  protected $availableIncludes = ['user', 'answers'];

  public function transform(Answer $answer)
  {
    return [
      'id' => $answer->id,
      'created_at' => $answer->created_at->toDateTimeString(),
      'created_at_human' => $answer->created_at->diffForHumans(),
      'user' => $answer->user_id,
      'score' => $answer->score,
      'video_file' => $answer->video->video_filename,
    ];
  }
// file_get_contents(storage_path('uploads/videos/'.$answer->video->video_filename)),
  public function includeUser(Answer $answer)
  {
    return $this->item($answer->user, new UserTransformer);
  }


}
 ?>
