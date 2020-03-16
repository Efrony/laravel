<?php

namespace App\Http\Controllers\Api;

use App\Resources;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiAdminController extends Controller
{
    public function userToAdmin(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->admin == 0) $user->admin = 1;
        else $user->admin = 0;
        $user->save();
        return response()->json(['status' => 'ok', 'id' => $request->id, 'admin' => $user->admin]);
    }

    public function createResource(Request $request)
    {
        if (!is_null($request->link)) {
            $resource = new Resources();
            $resource->link = $request->link;
            $resource->save();
            return response()->json([
                'status' => 'ok',
                'id' => $resource->id,
                'link' => $resource->link,
                'created_at' => $resource->created_at
            ]);
         }
        return response()->json(['status' => 'error']);
    }

    public function deleteResource(Request $request)
    {
        $resource= Resources::where('id', $request->id)->first();
        $resource->delete();
        return response()->json(['status' => 'ok', 'id' => $request->id]);
    }
}
