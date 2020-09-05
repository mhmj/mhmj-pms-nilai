<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPageController extends Controller
{
    public function company()
    {
        return view('pages.Customer.Personnel.Company.index');
    }
    public function user()
    {
        return view('pages.Customer.Personnel.User.index');
    }

}
