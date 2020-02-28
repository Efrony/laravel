<?php

namespace App\Http\Controllers;



class IndexController extends DataController
{
    public function home()
    {
        return view('index');
    }
}
