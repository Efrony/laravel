<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DataController;

class AdminIndexController extends DataController
{
    public function admin()
    {
        $title = 'Админка';
        return view('admin.admin', compact('title') );
    }
}
