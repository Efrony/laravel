<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DataController;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminUsersController extends DataController
{
    public function index()
    {
        return view('admin.users', [
            'title' => 'Пользователи',
            'users' => User::paginate(10),
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.user')->with([
            'title' => 'Редактирование пользователя',
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $validFields = $this->validate($this->request, User::rules());
        dd($validFields);
        $user->fill($validFields);
        if ($user->save()) {
            return redirect(route('admin.users.index'))->with('alert', [
                'type' => 'info',
                'message' => 'Пользователь успешно изменён!',
            ]);
        }
        return redirect(route('admin.user.index'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);
    }


    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect(route('admin.users.index'))->with('alert', [
                'type' => 'info',
                'message' => 'Пользователь удалён!',
            ]);
        }
        return redirect(route('admin.users.index'))->with('alert', [
            'type' => 'danger',
            'message' => 'Что-то пошло не так!',
        ]);
    }
}
