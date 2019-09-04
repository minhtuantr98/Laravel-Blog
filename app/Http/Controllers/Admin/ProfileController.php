<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.edit');
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
        
        return (['message' => 'Success']) ;
        // return redirect()->back()->with('message', 'Change Success');
    }
}
