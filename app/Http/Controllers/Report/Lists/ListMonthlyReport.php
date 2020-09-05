<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/9/2020
 * Time: 2:03 PM
 */

namespace App\Http\Controllers\Report\Lists;


use App\Mail\MonthlyReport;
use Illuminate\Support\Facades\Mail;

class ListMonthlyReport
{
    public function MonthlyReport()
    {
        return ('yes');
        return view('EmailReport');
//        Mail::to('it4@tecnic.com.my')->send(new MonthlyReport());
    }
}