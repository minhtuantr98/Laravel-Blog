<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Rules\OldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function index()
    {
        return view('admin.profile.password.edit');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required', 'string', new OldPassword],
            'password' => 'required|confirmed',

        ]);
        
        Auth::user()   
            ->fill([
                'password' => Hash::make($request->password),
            ])
            ->save();
        
        return (['message' => 'Success']);
        // return redirect()->back()->with('message', 'Change success');

    }
}
