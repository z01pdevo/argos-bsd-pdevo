<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionGroup;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function reorder(Request $request)
    {
        $request->validate([
            'ids'                   => 'required|array',
            'ids.*'                 => 'integer',
            'questiongroup_id'      => 'required|integer|exists:question_groups,id',
        ]);

        foreach ($request->ids as $index => $id) {
            DB::table('questions')
            ->where('id', $id)
                ->update([
                    'order'             => $index + 1,
                    'question_group_id' => $request->questiongroup_id
                ]);
        }

        $orders = QuestionGroup::find($request->questiongroup_id)
            ->questions()
            ->pluck('order', 'id');

        return response(compact('orders'), Response::HTTP_OK);
    }

    public function getTotalMaxScore()
    {
        return Question::all()->sum('max_score');
    }

    public function getTotalActiveMaxScore()
    {
        return Question::where('active', TRUE)->sum('max_score');
    }

    public function getById($id)
    {
        return Question::where('id', $id)->get();
    }

    public function getAllByImportanceType($importance)
    {
        return Question::where('importance', $importance)->orderBy('order', 'asc')->get();
    }

    public function getAllActive()
    {
        return Question::where('active', TRUE)->orderBy('order', 'asc')->get();
    }

    public function getAllInactive()
    {
        return Question::where('active', FALSE)->orderBy('order', 'asc')->get();
    }

    public function getAll()
    {
        return Question::all();
    }

    public function getScoreById($id)
    {
        return Question::where('id', $id)->get()->first()->max_score;
    }

    public function edit($id)
    {
//        abort_if(Gate::denies('update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questiongroups = QuestionGroup::all()->sortBy('id')->pluck('text', 'id')->prepend('Seleciona um Grupo');

        $question = Question::where('id',$id)->with('questiongroup')->get()->first();

        return view('admin.questions.edit', compact('questiongroups', 'question'));
    }


    public function update(Request $request, Question $question, $id)
    {

        $input = $request->all();
        unset($input["_token"]);

        Question::where('id', $id)->update($input);

        return redirect()->route('admin.questions');
    }

}
