<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index($locale) 
    {
        Session::put('locale', $locale);

        return redirect('/');
    }
}
