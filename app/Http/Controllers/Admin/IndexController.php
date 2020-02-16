<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function admin()
    {
        $title = 'Админка';
        return view('admin', compact('title') );
    }
}
