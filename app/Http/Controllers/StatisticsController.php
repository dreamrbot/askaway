<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;

class StatisticsController extends Controller
{
    public function show(Request $request, Profile $profile)
    {
      $profile = $request->user()->profile()->first();

      return response()->json([
        'score' => $profile->score,
        'max_score' => $profile->max_score,
        'min_score' => $profile->min_score,
        'avg_given_score' => $profile->avg_given_score,
        'given_scores_count' => $profile->given_scores_count,
        'avg_score_7_days' => $profile->avg_score_7_days,
        'questions_count' => $profile->questions_count,
        'answers_count' => $profile->answers_count,
      ], 200);
    }

}
