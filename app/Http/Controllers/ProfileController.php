<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password_new' => 'confirmed',
        ];
    }
    public function attributeNames() {
        return [
            'password_new' => 'Новый пароль',
        ];
    }


    public function edit()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validFields = $this->validate($request, $this->rules(), [], $this->attributeNames());
        if (Hash::check($request->input('password'), $user->password)) {
            if ($newPassword = $request->input('password_new')) {
                $validFields['password'] = Hash::make($newPassword);
            }
            $user->fill($validFields);
            $user->save();
            return redirect()->route('profile.edit')->with('alert', [
                'type' => 'success',
                'message' => 'Данные профиля успешно изменены',
            ]);
        }
        $errors = [];
        $errors['password'][] = 'Текущий пароль не верный';
        return redirect()->route('profile.edit')->withErrors($errors);

    }
}
