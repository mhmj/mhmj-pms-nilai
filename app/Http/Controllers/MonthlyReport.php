<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/9/2020
 * Time: 10:50 AM
 */

namespace App\Http\Controllers;


//use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;

class MonthlyReport
{
    public function EmailReport()
    {
        return view('EmailReport');
    }
}