<?php

namespace App\Http\Controllers;

use App\User;
use Exceptions;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function changePassword(Request $request)
    {
        $validateData = $request->validate(['password' => 'required|confirmed|min:6']); //két input mező megegyezzen (confirmed)
        $user = auth()->user(); //bejelentkezett felhasználó
        $user->password = Hash::make($validateData['password']);
        $user->save();
        return redirect('/profile');

    }
}