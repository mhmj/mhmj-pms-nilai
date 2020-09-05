<?php

namespace App\Console\Commands;

use App\Company;
use App\Mail\MonthlyReport;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /** @var  Company */
    private $repository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Plastictecnic - PMS Monthly Report ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Company $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to('it4@tecnic.com.my')->send(new MonthlyReport());
//            Mail::raw('Okay', function ($message) {
//            $data = $this->repository->findOrFail(1);
//            $message->to('it4@tecnic.com.my')
//            ->subject('Okay');
//            });
//
//            Mail::send(['html' => 'monthly_report_email'], function ($message) {
////            $data = $this->repository->findOrFail(1);
//            $message->to('it4@tecnic.com.my')
//            ->subject('Okay');
//            });
//
//        Mail::send(['html' => 'monthly_report_email'], function($message)
//        {
//            $message -> from('Plastictecnic (M) Sdn. Bhd.', 'Plastictecnic');
//
//            $message->subject ("Plastictecnic - PMS Monthly Report");
//
//            $message->to('it4@tecnic.com.my');
//        });

//        Log::info('Cron Job Started');
//        // your logic
//        Log::info('Cron Job Ended');
//       Mail::send(['html' => '/'], function($message)
//       {
//           $message -> from('Plastictecnic (M) Sdn. Bhd.', 'Plastictecnic');
//
//           $message->subject ("Plastictecnic - PMS Monthly Report");
//
//           $message->to('it4@tecnic.com.my');
//       });
    }
}
