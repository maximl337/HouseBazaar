<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSettings()
    {
        $user = Auth::user();

        return view('account.settings', compact('user'));
    }

    public function postSettings(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255|unique:users,name,'. Auth::id(),
                'email' => 'required|email|max:255|unique:users,email,'. Auth::id()
            ]);

        Auth::user()->update($request->input());

        flash()->overlay("Success", "Account updated successfully", 'success');

        return back();
    }
}
