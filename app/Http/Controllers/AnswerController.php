<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function create($new_answer)
    {
        $answer = Answer::create(
            [
                'report_id'         => $new_answer->answer_id,
                'question_id'       => $new_answer->text,
                'user_id'           => $new_answer->compromise_at,
                'answer'            => $new_answer->importance,
                'score'             => $new_answer->score,
            ]
        );
        return $answer;
    }

    public function update($id)
    {
        $answer = Answer::where('id', $id)
            ->update([
                'user_id'       => auth()->id,
                'answer'        => TRUE,
                'updated_at'    => now(),
            ]);

        return $answer;
    }

    public function updateOrCreate($answer,$report_id, $question_id, $user_id, $score = 0)
    {

        $arrayToCreate = [
            'report_id'     => $report_id,
            'question_id'   => $question_id,
            'user_id'       => $user_id,
            'answer'        => $answer,
            'score'         => $score,
        ];



        $result = Answer::firstOrCreate(
            [
                'report_id' => $report_id,
                'question_id' => $question_id,
                'user_id' => $user_id,
            ],
            $arrayToCreate
        );


        if ($result->wasRecentlyCreated) {
            // Do nothing
        } else {
            Answer::where('id', $result->id)
                ->update($arrayToCreate);
        }

        return $result->id;

    }

    public function getAllAnswersForReportId($report_id)
    {
        return Answer::where('report_id', $report_id)->with(['question','actionplan','attachment'])->get();
    }

    public function getAllAnswersNoAndYesButForReportId($report_id)
    {
        return Answer::where('report_id', $report_id)
                ->where(function($query) {
                    $query->where('answer','=', 'no')
                        ->orWhere('answer','=', 'yesbut');
                })
                ->orderBy('answer', 'asc')
                ->with(['question','comment'])->get();
    }



}
