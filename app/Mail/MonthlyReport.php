<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonthlyReport extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $month = Carbon::now()->format('F');
        $now = $now = Carbon::now();
        return $this->view('pages.monthly_report_email')
                    ->subject('Packaging Summary for '. $month .' - ' . $now->year)
                    ->with([
                    'month' => $month,
                    'year' => $now->year,
                    ]);
    }
}
