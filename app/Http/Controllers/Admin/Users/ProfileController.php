<?php

namespace App\Http\Controllers\Admin\Users;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ModelCouldNotDeletedException;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function listting() 
    {
        return User::where('is_admin', 0)->orderBy('id', 'desc')->paginate(5);
    }

    public function edit($id)
    {
        if (User::find($id)->is_admin == 1 && Auth::user()->id != User::find($id)->id) {
            return redirect()->back();
        }
        
        $user = User::findOrFail($id);

        return view('admin.users.profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.User::find($id)->id.'',
        ]);

        User::findOrFail($id)
            ->fill([
                'name' => $request->name,
                'email' => $request->email,
            ])
            ->save();
        
        return (['message' => 'Change Success']);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        User::forceCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->input('admin', 0), 
        ]);
    
        return (['message' => 'Success']);;
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->firstOrFail()->delete();
        } catch (ModelCouldNotDeletedException $exception) {
            return (['error' => 'U cant delete it']);
        }
        
        return User::where('is_admin', 0)->orderBy('id', 'desc')->paginate(5);;
    }
}
