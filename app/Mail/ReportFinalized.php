<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportFinalized extends Mailable
{
    use Queueable, SerializesModels;

    public Report $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('[Argos Segurança] '. $this->report->created_at->format('d-m-Y') .' - Diagnóstico '. $this->report->site->name . ' finalizado!')
                ->view('emails.report-finalized')
                ->with([
                    'report' => $this->report,
                ]);
    }
}
