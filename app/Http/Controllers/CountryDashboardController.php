<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\Answer;
use App\Models\Report;
use App\Models\Site;
use DB;
use Illuminate\Http\Request;

class CountryDashboardController extends Controller
{
    private function totalReportFinished(){;
        return Report::where('finished_at', '!=', NULL)->get()->count();
    }

    private function totalAnswersNoAndYesbut(){
        return Answer::where('answer' , '!=' , 'yes')->get()->count();
    }

    private function totalActionPlansDone(){
        $done   = ActionPlan::where( 'done' , true)->where('importance', '=', 'high')->get()->count();
        $all    = ActionPlan::where('importance', '=', 'high')->count();

        return [
            'done'      => $done,
            'all'   => $all
        ];
    }

    private function totalRecommendedDone(){
        $done   = ActionPlan::where( 'done' , true)->where('importance', '=', 'low')->get()->count();
        $all    = ActionPlan::where('importance', '=', 'low')->count();

        return [
            'done'      => $done,
            'all'   => $all
        ];
    }

    private function top10BigRisks(){

        $result = Answer::where('answer', '=', 'no')
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

        return json_encode($top10);
    }

    private function averageReportResults(){
        return Report::where('finished_at', '!=', NULL)
                        ->select(DB::raw('(score / cast(max_score as float))*100 as result'))
                        ->get()
                        ->average('result');
    }

    private function sitesComparison(){

        $comparison_sites = Site::with(['reports' => function ($q) {
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

        return view('country-dashboard', [
            'total_report_finished'           => $this->totalReportFinished(),
            'total_answers_no_and_yesbut'     => $this->totalAnswersNoAndYesbut(),
            'total_action_plans_done'         => $this->totalActionPlansDone(),
            'total_recommended_done'          => $this->totalRecommendedDone(),
            'top10_big_risks'                 => $this->top10BigRisks(),
            'average_report_results'          => $this->averageReportResults(),
            'sites_comparison'                => $this->sitesComparison(),
        ]);

    }
}
