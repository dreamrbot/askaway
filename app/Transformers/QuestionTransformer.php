<?php

namespace App\Transformers;

use App\Question;

class QuestionTransformer extends \League\Fractal\TransformerAbstract
{
  protected $availableIncludes = ['user', 'answers', 'video'];

  public function transform(Question $question)
  {
    return [
      'id' => $question->id,
      'video_id' => $question->video_id,
      'created_at' => $question->created_at->toDateTimeString(),
      'created_at_human' => $question->created_at->diffForHumans(),
    ];
  }

  public function includeUser(Question $question)
  {
    return $this->item($question->user, new UserTransformer);
  }

  public function includeAnswers(Question $question)
  {
    return $this->collection($question->answers, new AnswerTransformer);
  }
  public function includeVideo(Question $question)
  {
    return $this->item($question->video, new VideoTransformer);
  }

  


}
 ?>
