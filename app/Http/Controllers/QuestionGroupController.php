<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionGroup;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class QuestionGroupController extends Controller
{

    public function reorder(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer',
        ]);

        foreach ($request->ids as $index => $id) {
            DB::table('question_groups')
            ->where('id', $id)
                ->update([
                    'order' => $index + 1
                ]);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getTotalMaxScore()
    {
        return QuestionGroup::all()->sum('max_score');
    }

    public function getTotalActiveMaxScore()
    {
        return QuestionGroup::where('active', TRUE)->sum('max_score');
    }

    public function getById($id)
    {
        return QuestionGroup::where('id', $id)->get();
    }

    public function getAllByImportanceType($importance)
    {
        return QuestionGroup::where('importance', $importance)->orderBy('order', 'asc')->get();
    }

    public function getAllActive()
    {
        return QuestionGroup::where('active', TRUE)->orderBy('order', 'asc')->get();
    }

    public function getAllActiveWithQuestions()
    {
        return QuestionGroup::where('active', TRUE)->orderBy('order', 'asc')->with('questions')->get();
    }

    public function getAllInactive()
    {
        return QuestionGroup::where('active', FALSE)->orderBy('order', 'asc')->get();
    }

    public function getAll()
    {
        return QuestionGroup::all();
    }

    public function deactivate($id)
    {
        QuestionGroup::where('id', $id)->update([
            'active' => FALSE,
            'updated_at' => now(),
        ]);

        $question_group = QuestionGroup::find($id);


        return $question_group;
    }

    public function activate($id)
    {
        QuestionGroup::where('id', $id)->update([
            'active' => TRUE,
            'updated_at' => now(),
        ]);

        $question_group = QuestionGroup::find($id);

        return $question_group;
    }

    public function edit($id)
    {
//        abort_if(Gate::denies('update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questiongroup = QuestionGroup::where('id',$id)->get()->first();

        return view('admin.questiongroups.edit', compact('questiongroup'));
    }


    public function update(Request $request, QuestionGroup $questiongroup)
    {
//        $input = $request->all();
//        unset($input["_token"]);
//
//        $questiongroup = QuestionGroup::find($id);
//
//        dd($input);

        $questiongroup->update($request->all());

        return redirect()->route('admin.questiongroups');
    }

}
