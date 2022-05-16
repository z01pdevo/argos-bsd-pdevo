<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\Answer;
use App\Models\Report;
use App\Models\Site;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyDashboardController extends Controller
{

    private User $user;

    private function totalReportFinished(){;
        return Report::where('finished_at', '!=', NULL)->where('site_id', $this->user->site->id)->get()->count();
    }

    private function totalAnswersNoAndYesbut(){

        return $this->user->site->answers->where('answer' , '!=' , 'yes')->count();

    }

    private function totalActionPlansDone(){

        $done   = $this->user->site->actionplans->where( 'done' , true)->where('importance', '=', 'high')->count();
        $all    = $this->user->site->actionplans->where('importance', '=', 'high')->count();

        return [
            'done'      => $done,
            'all'   => $all
        ];


    }

    private function totalRecommendedDone(){

        $done   = $this->user->site->actionplans->where( 'done' , true)->where('importance', '=', 'low')->count();
        $all    = $this->user->site->actionplans->where('importance', '=', 'low')->count();

        return [
            'done'      => $done,
            'all'   => $all
        ];
    }

    private function top10BigRisks(){

        /* TODO find a way to filter the answers to answers of the current site */

        $result = Answer::where('answer', '=', 'no')->with([
                                                    'report' => function ($q) { $q->where('site_id', 2/*$this->user->site->id*/);},
                                                    'question'])
            ->groupBy('question_id')
            ->select('question_id', DB::raw('count(*) as total'))
            ->with('question')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->get();
        $top10 = [];


        foreach ($result as $question){

            $temp = [
                'x' => $question->question->text,
                'y' => $question->total
            ];

            array_push($top10, $temp);

        }

        dd($top10);

        return json_encode($top10);
    }

    private function averageReportResults(){
        return Report::where('finished_at', '!=', NULL)
            ->where('site_id', $this->user->site->id)
            ->select(DB::raw('(score / cast(max_score as float))*100 as result'))
            ->get()
            ->average('result');
    }



    private function sitesComparison(){

        $comparison_sites = Site::where('id', $this->user->site->id)->with(['reports' => function ($q) {
            $q->where('finished_at', '>', '2021-01-29 17:00:00.000')
                ->orderBy('finished_at', 'desc');
        }])->get();

        $prepared_comparison_series_1 = [];
        $prepared_comparison_series_2 = [];
        $prepared_comparison_sites = [];


        foreach ($comparison_sites as $c_site){

            $temp_reports = $c_site->reports->sortByDesc('finished_at')->take(2);

            if(count($temp_reports) === 0)
                continue;

            $score_1 = round( ($temp_reports->first()->score / ($temp_reports->first()->max_score )) *100 , 1);
            $score_2 = round( ($temp_reports->last()->score / ($temp_reports->last()->max_score )) *100, 1);


            array_push($prepared_comparison_series_1, $score_1);
            array_push($prepared_comparison_series_2, $score_2);

            array_push($prepared_comparison_sites, $c_site->name);


        }


        $comparison = [
            'data_1' => $prepared_comparison_series_1,
            'data_2' => $prepared_comparison_series_2,
            'labels' => $prepared_comparison_sites
        ];

        return $comparison;
    }


    public function getDashboardData(){

        $this->user = Auth::user();

        return view('welcome', [
            'total_report_finished'           => $this->totalReportFinished(),
            'total_answers_no_and_yesbut'     => $this->totalAnswersNoAndYesbut(),
            'total_action_plans_done'         => $this->totalActionPlansDone(),
            'total_recommended_done'          => $this->totalRecommendedDone(),
//            'top10_big_risks'                 => $this->top10BigRisks(),
            'average_report_results'          => $this->averageReportResults(),
            'sites_comparison'                => $this->sitesComparison(),
        ]);

    }
}
