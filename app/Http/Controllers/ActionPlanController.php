<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionPlanController extends Controller
{

    public function create($new_action_plan)
    {
        $action_plan = ActionPlan::create(
            [
                'answer_id'             => $new_action_plan['answer_id'],
                'text'                  => $new_action_plan['text'],
                'compromise_at'         => $new_action_plan['compromise_at'],
                'importance'            => $new_action_plan['importance'],
            ]
        );
        return $action_plan;
    }

    public function updateOrCreate($new_action_plan)
    {

        $arrayToCreate = [
            'answer_id'             => $new_action_plan['answer_id'],
            'text'                  => $new_action_plan['text'],
            'who'                   => $new_action_plan['who'],
            'compromise_at'         => $new_action_plan['compromise_at'],
            'importance'            => $new_action_plan['importance'],
        ];

        $result = ActionPlan::firstOrCreate(
            [
                'answer_id' => $new_action_plan['answer_id'],
            ],
            $arrayToCreate
        );


        if ($result->wasRecentlyCreated) {
            // Do nothing
        } else {
            ActionPlan::where('id', $result->id)
            ->update($arrayToCreate);
        }

        return $result->id;

    }

    public function finalize($id)
    {
        ActionPlan::where('id', $id)
            ->update([
                'done'                  => TRUE,
                'done_by_id'            => Auth::user()->id,
                'updated_at'            => now(),
            ]);

        return redirect()->route('my.pending-action-plans');
    }



}
