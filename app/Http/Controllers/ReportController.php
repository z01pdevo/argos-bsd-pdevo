<?php

namespace App\Http\Controllers;

use App\Mail\ReportFinalized;
use App\Mail\ActionPlanCreated;
use Carbon\Carbon;
use App\Models\Report;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReportRequest;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroy($id): Response
    {
        Report::find($id)->delete();

        //TODO Setup cascade delete of all info associated with it! --> Checkout: https://stackoverflow.com/questions/14174070/automatically-deleting-related-rows-in-laravel-eloquent-orm

        return back();
    }

    public function getAll()
    {
        return Report::all();
    }

    public function getAllFinishedWithoutActionPlans()
    {
        return Report::where('finished_at', NULL)->get();
    }

    public function showAllFinished()
    {
        $reports = Report::where('finished_at', '!=', NULL)->get();

        return view('reports-country', [
            'reports' => $reports
        ]);
    }

    public function getById($id)
    {
        return Report::where('id', $id)->get()->first();
    }

    public function getByIdWithSiteInfo($id)
    {
        return Report::where('id', $id)->with('site')->get()->first();
    }

    public function getActionPlansById($id)
    {
        return Report::where('id', $id)->first()->actionplans;
    }

    public function getCommentsById($id)
    {
        return Report::where('id', $id)->first()->comments;
    }

    public function getAnswersById($id)
    {
        return Report::where('id', $id)->first()->answers;
    }

    public function getSiteById($id)
    {
        return Report::where('id', $id)->first()->site;
    }

    public function getUserById($id)
    {
        return Report::where('id', $id)->first()->user;
    }

    /**! TODO  */
    public function getAnswersQuestions($id)
    {
        ## return Report::where('id', $id)->first()->answers;


        $sites::with(['reports' => function ($q) {$q->where('finished_at', '>', '2022-01-29 17:00:00.000')->orderBy('finished_at', 'desc');}])->get();
    }

    public function updateTimeActive($id, $time_active)
    {
        $report = Report::find($id);

        $report->time_active = $time_active;
        $report->updated_at = now();

        $report->save();

        return $report;
    }

    public function update($new_report_info, $time_active)
    {
        $questionsc = new QuestionController;

        $report = Report::where('id', $new_report_info->id)
            ->update([
                'name'                  => $new_report_info->site,
                'description'           => $new_report_info->type,
                'score'                 => $this->getAnswersById($new_report_info->id)->sum('score'),
                'max_score'             => $questionsc->getMaxScore(),
                'time_active'           => $time_active,
                'updated_at'            => now(),
            ]);

        return $report;
    }

    public function create(StoreReportRequest $request)
    {

        $c_site = new SiteController;
        $site = $c_site->getById($request->input('site_id'));

        $to_data = $c_site->getDDAPerformances($request->input('site_id'));

        $new_report = Report::create(
            [
                'name'          => Carbon::now()->format('Y-m-d') . " - ARGOS Segurança - " . $site->name,
                'site_id'       => $request->input('site_id'),
                'user_id'       => Auth::user()->id,
                'to_dda'        => $to_data['to_dda'],
                'to_progression'=> $to_data['to_progression'],
            ]
        );

        return redirect()->route('reports.continue', ['id' => $new_report->id]);
    }

    public function continue($id)
    {
        $controller = new QuestionGroupController;
        $questiongroups = $controller->getAllActiveWithQuestions();


        $current_site = $this->getSiteById($id);

        $c_answers = new AnswerController;
        $currentAnswers = $c_answers->getAllAnswersForReportId($id);

        $comments = $this->getCommentsById($id);

        return view('continue-report', [
            'questiongroups' => $questiongroups,
            'current_site'   => $current_site,
            'current_report' => $this->getById($id),
            'currentAnswers' => $currentAnswers,
            'comments'       => $comments,
        ]);
    }

    public function autosave_submit(Request $request, $id)
    {

        $request->validate([
            'email_to' => 'email_array',
            'email_cc' => 'email_array',
        ]);

        $c_answer = new AnswerController;
        $c_question = new QuestionController;
        $c_report = new ReportController;
        $c_comment = new CommentController;
        $c_attachment = new AttachmentController;

        $disk = Storage::disk('gcs');



        $user_id = Auth::user()->id;



        foreach ( array_keys($request->all()) as $key) {

            if($request->filled($key)){

                if(Str::startsWith($key, ['answer_'])){

                    $question_id = Str::after($key, 'answer_');
                    $answer = $request->input($key);
                    $score = $c_question->getScoreById($question_id);

                    // Create or Update the answer and get the ID of it
                    $answer_id = $c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);

                    /**
                     * if há comments desta questão
                     * juntar o comentário
                     **/
                    if ($request->filled('comment_'.$question_id)) {

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'text'          => $request->input('comment_'.$question_id),
                        ];

                        $c_comment->updateOrCreate($arrayToCreate);
                        // Criar um novo comentário

                    }

                    /**
                     * if há attachments desta questão
                     * juntar a foto
                     **/
                    if ($request->file('photo_'.$question_id) != null){

                        // upload the file the folder 'test-argos-security' and get it's path
                        $url = $disk->put('test-argos-security' , $request->file('photo_'.$question_id));

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'url'           => $url,
                            'size'          => $request->file('photo_'.$question_id)->getSize(),
                            'type'          => $request->file('photo_'.$question_id)->extension(),
                        ];

                        $c_attachment->updateOrCreate($arrayToCreate);
                        // Criar um novo attachment
                    }

                }
                elseif ( Str::startsWith($key, ['comment_']) ){

                    $question_id = Str::after($key, 'comment_');

                    //encontrar se existe uma resposta para este no request inteiro!
                    if (!$request->filled('answer_'.$question_id)) {

                        //Doesnt have; so create an empty or NA one
                        //Just need a "custom" call for this one:
                        //$c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);

                        $answer_id = $c_answer->updateOrCreate(null, $id, $question_id, $user_id);

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'text'          => $request->input('comment_'.$question_id),
                        ];

                        $c_comment->updateOrCreate($arrayToCreate);
                        // Criar um novo comentário

                    }

                }
                elseif ( Str::startsWith($key, ['photo_']) ){

                    $question_id = Str::after($key, 'photo_');

                    //encontrar se existe uma resposta para este no request inteiro!
                    if (!$request->filled('answer_'.$question_id)) {

                        //Doesnt have; so create an empty or NA one
                        //Just need a "custom" call for this one:
                        //$c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);
                        $answer_id = $c_answer->updateOrCreate(null, $id, $question_id, $user_id);

                        // upload the file the folder 'test-argos-security' and get it's url path
                        $url = $disk->put('test-argos-security' , $request->file('photo_'.$question_id));

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'url'           => $url,
                            'size'          => $request->file('photo_'.$question_id)->getSize(),
                            'type'          => $request->file('photo_'.$question_id)->extension(),
                        ];

                        dd($arrayToCreate);
                        $c_attachment->updateOrCreate($arrayToCreate);
                        // Criar um novo attachment

                    }

                }

            }

        }

        $report = $c_report->getById($id);

        $report->to_dda             = $request->input('to_dda');
        $report->to_progression     = $request->input('to_progression');
        $report->rbe_dda            = $request->input('rbe_dda');
        $report->mrbe_dda           = $request->input('mrbe_dda');
        $report->demarque_dda       = $request->input('demarque_dda');
        $report->quantity_workers   = $request->input('quantity_workers');
        $report->weekly_hours       = $request->input('weekly_hours');
        $report->share_exploitation = $request->input('share_exploitation');

        $report->score              = $report->answers()->sum('score');
        $report->max_score          = $c_question->getTotalActiveMaxScore();
        //$report->time_active        = $time_active;

        $report->user_id            = $user_id;

        // TODO Preparar o alert level e tempo activo
        //$report->alert_level_id     = "TODO";
        //$report->time_active        = "TODO";

        $report->updated_at         = now();

//        DON'T close until action plans are done
//        $report->finished_at        = now();
//        $report->is_finished        = TRUE;

        $report->finished_at        = now();
        $report->is_finished        = TRUE;

        $report->save();


        $cc_users = [
            $report->site->exploitation_email,
            $report->site->manager_email,
            $report->site->regional_email,
        ];

        if($request->input('email_to') != null){
            foreach(explode(',',$request->input('email_to')) as $email){
                $cc_users = Arr::prepend($cc_users,$email);
            };
        }

        Mail::to($report->user->email)
            ->cc($cc_users)
            ->queue(new ReportFinalized($report));

        return "Done Successfully!";

        //return redirect()->route('reports.createactionplans', ['id' => $report->id]);
    }

    public function autosave(Request $request, $id)
    {
        $c_answer = new AnswerController;
        $c_question = new QuestionController;
        $c_report = new ReportController;
        $c_comment = new CommentController;
        $c_attachment = new AttachmentController;

        $disk = Storage::disk('gcs');

        $user_id = Auth::user()->id;



        foreach ( array_keys($request->all()) as $key) {

            if($request->filled($key)){

                if(Str::startsWith($key, ['answer_'])){

                    $question_id = Str::after($key, 'answer_');
                    $answer = $request->input($key);
                    $score = $c_question->getScoreById($question_id);

                    // Create or Update the answer and get the ID of it
                    $answer_id = $c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);

                    /**
                     * if há comments desta questão
                     * juntar o comentário
                     **/
                    if ($request->filled('comment_'.$question_id)) {

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'text'          => $request->input('comment_'.$question_id),
                        ];

                        $c_comment->updateOrCreate($arrayToCreate);
                        // Criar um novo comentário

                    }

                    /**
                     * if há attachments desta questão
                     * juntar a foto
                     **/
                    if ($request->file('photo_'.$question_id) != null){

                        // upload the file the folder 'test-argos-security' and get it's url
                        $url = $disk->put('test-argos-security' , $request->file('photo_'.$question_id));

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'url'           => $url,
                            'size'          => $request->file('photo_'.$question_id)->getSize(),
                            'type'          => $request->file('photo_'.$question_id)->extension(),
                        ];

                        $c_attachment->updateOrCreate($arrayToCreate);
                        // Criar um novo attachment
                    }

                }
                elseif ( Str::startsWith($key, ['comment_']) ){

                    $question_id = Str::after($key, 'comment_');

                    //encontrar se existe uma resposta para este no request inteiro!
                    if (!$request->filled('answer_'.$question_id)) {

                        //Doesnt have; so create an empty or NA one
                        //Just need a "custom" call for this one:
                        //$c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);

                        $answer_id = $c_answer->updateOrCreate(null, $id, $question_id, $user_id);

                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'text'          => $request->input('comment_'.$question_id),
                        ];

                        $c_comment->updateOrCreate($arrayToCreate);
                        // Criar um novo comentário

                    }

                }
                elseif ( Str::startsWith($key, ['photo_']) ){

                    $question_id = Str::after($key, 'photo_');

                    //encontrar se existe uma resposta para este no request inteiro!
                    if (!$request->filled('answer_'.$question_id)) {

                        //Doesnt have; so create an empty or NA one
                        //Just need a "custom" call for this one:
                        //$c_answer->updateOrCreate($answer, $id, $question_id, $user_id, $score);
                        $answer_id = $c_answer->updateOrCreate(null, $id, $question_id, $user_id);

                        // upload the file the folder 'test-argos-security' and get it's url
                        $url = $disk->put('test-argos-security' , $request->file('photo_'.$question_id));


                        $arrayToCreate = [
                            'answer_id'     => $answer_id,
                            'url'           => $url,
                            'size'          => $request->file('photo_'.$question_id)->getSize(),
                            'type'          => $request->file('photo_'.$question_id)->extension(),
                        ];

                        dd($arrayToCreate);
                        $c_attachment->updateOrCreate($arrayToCreate);
                        // Criar um novo attachment

                    }

                }

            }

        }

        $report = $c_report->getById($id);


        if($request->filled('to_dda')){
            $report->to_dda             = $request->input('to_dda');
        }
        if($request->filled('to_progression')){
            $report->to_progression     = $request->input('to_progression');
        }
        if($request->filled('rbe_dda')){
            $report->rbe_dda            = $request->input('rbe_dda');
        }
        if($request->filled('mrbe_dda')){
            $report->mrbe_dda           = $request->input('mrbe_dda');
        }
        if($request->filled('demarque_dda')){
            $report->demarque_dda       = $request->input('demarque_dda');
        }
        if($request->filled('quantity_workers')){
            $report->quantity_workers   = $request->input('quantity_workers');
        }
        if($request->filled('weekly_hours')){
            $report->weekly_hours       = $request->input('weekly_hours');
        }
        if($request->filled('share_exploitation')){
            $report->share_exploitation   = $request->input('share_exploitation');
        }
        if($request->filled('score')){
            $report->score              = $report->answers()->sum('score');
        }
        if($request->filled('max_score')){
            $report->max_score          = $c_question->getTotalActiveMaxScore();
        }


        //$report->time_active        = $time_active;

        $report->user_id            = $user_id;

        // TODO Preparar o alert level e tempo activo
        //$report->alert_level_id     = "TODO";
        //$report->time_active        = "TODO";

        $report->updated_at         = now();

        $report->save();

        return response([
            'message' => 'Autosaved done'
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $controller = new QuestionGroupController;
        $questiongroups = $controller->getAllActiveWithQuestions();

        $c_answers = new AnswerController;

        $current_report = $this->getByIdWithSiteInfo($id);
        $currentAnswers = $c_answers->getAllAnswersForReportId($current_report->id);

        $actionplans = $this->getActionPlansById($current_report->id);

        $comments = $this->getCommentsById($current_report->id);

        return view('show-report', [
            'questiongroups' => $questiongroups,
            'current_report' => $current_report,
            'currentAnswers' => $currentAnswers,
            'actionplans'    => $actionplans,
            'comments'       => $comments,
        ]);
    }

    public function createActionPlans($id){

        $c_answer = new AnswerController;

        $answers_no_yesbut = $c_answer->getAllAnswersNoAndYesButForReportId($id);


        return view('create-actionplans', [
            'answersNoYesBut' => $answers_no_yesbut,
            'current_report' => $this->getById($id)
        ]);

    }

    public function finalize(Request $request, $id)

    {

        $request->validate([
            'email_to' => 'email_array',
            'email_cc' => 'email_array',
        ]);

        $c_report = new ReportController;
        $c_actionplan = new ActionPlanController;
        $c_answer = new AnswerController;

        $user_id = Auth::user()->id;

        foreach ( array_keys($request->all()) as $key) {

            if($request->filled($key)){

                if(Str::startsWith($key, ['what_answerid_'])){



                    $answer_id = Str::after($key,'what_answerid_');

                    $arrayToCreate = [
                        'answer_id'     => $answer_id,
                        'text'          => $request->input('what_answerid_'.$answer_id) ?? '',
                        'who'           => $request->input('who_answerid_'.$answer_id) ?? '',
                        'compromise_at' => $request->input('compromised_at_answerid_'.$answer_id) ?? '',
                        'importance'    => $request->input('importance_answerid_'.$answer_id) ?? '',
                    ];

                    $c_actionplan->updateOrCreate($arrayToCreate);

                }

            }

        }

        $report = $c_report->getById($id);


        $cc_users = [
            $report->site->exploitation_email,
            $report->site->manager_email,
            $report->site->regional_email,
        ];

        if($request->input('email_to') != null){
            foreach(explode(',',$request->input('email_to')) as $email){
                $cc_users = Arr::prepend($cc_users,$email);
            };
        }

        $report->has_actionplans = TRUE;

        $report->save();

        $actionplans = $c_report->getActionPlansById($id);


        Mail::to($report->user->email)
            ->cc($cc_users)
            ->queue(new ActionPlanCreated($report, $actionplans));


        return "Done Successfully!";
    }

}
