<?php

namespace App\Http\Controllers\Admin\Users;

use App\User;
use App\Rules\OldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function edit($id)
    {
        return view('admin.users.profile.password.edit')->with('id', $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
        ]);
        
        User::find($id) 
            ->fill([
                'password' => Hash::make($request->password),
            ])
            ->save();
        
        return (['message' => 'Change success']);
    }
}
