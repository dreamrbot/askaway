<?php

namespace App\Transformers;


use App\Videos;
class VideoTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Videos $video)
    {
        return [
          'video_name' => $video->video_filename,
          'video' => file_get_contents(storage_path('uploads/videos/'.$video->$filename))
        ];
    }

}
