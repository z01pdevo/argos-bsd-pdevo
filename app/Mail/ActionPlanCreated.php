<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActionPlanCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Report $report;
    public Collection $actionplans;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $actionplans)
    {
        $this->report = $report;
        $this->actionplans = $actionplans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('[Argos Segurança] '. $this->report->created_at->format('d-m-Y') .' - Plano Acção Criado! - '. $this->report->site->name)
                ->view('emails.actionplan-created')
                ->with([
                    'report' => $this->report,
                    'actionplans' => $this->actionplans,
                ]);
    }
}
