<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OutilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   

    public function optimize() 
{
    Artisan::call('optimize');
}

public function clear() 
{
    Artisan::call('optimize:clear');
}

}
