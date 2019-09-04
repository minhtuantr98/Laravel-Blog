<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('users.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id.'',
        ]);

        Auth::user()
            ->fill([
                'name' => $request->name,
                'email' => $request->email,
            ])
            ->save();

        return redirect()->back()->with('message', 'Change Success');
    }
}
