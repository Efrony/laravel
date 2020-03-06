<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminIndexController extends Controller
{
    public function admin()
    {
        return view('admin.index', ['title'=> 'Админка'] );
    }
}
