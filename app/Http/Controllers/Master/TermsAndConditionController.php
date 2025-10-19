<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        return view("pages.landing-page.terms-condition");
    }
}
