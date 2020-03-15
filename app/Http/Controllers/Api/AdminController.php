<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function userToAdmin(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->admin == 0) $user->admin = 1;
        else $user->admin = 0;
        $user->save();
        return response()->json(['status' => 'ok', 'id' => $request->id, 'admin' => $user->admin]);
    }
}
