<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            /*'description' => ['string', 'max:255']*/
        ]);

        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return redirect('/profile/');
    }

    public function avatar_change(Request $request) {
        if(empty($request->file('avatar'))) {
            abort(500);
        }

        $old_path = User::where('id', Auth::user()->id)->first();
        $old_path = $old_path->avatar;

        $path = $request->file('avatar')->store('/profile');

        Storage::delete('/profile/'.$old_path);

        $path = str_replace('profile/', '' , $path);
        User::where('id', Auth::user()->id)->update([
            'avatar' => $path
        ]);

        return redirect()->back();
    }
}
