<?php

namespace App\Http\Controllers\Profile;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function edit()
    {
        return view('frontend.user.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $this->validateForm($request);

        $data = !$request->filled('password')
            ? $request->except('password')
            : $request->all();

        Auth::user()->fill($data)->save();

        return redirect()
            ->back()
            ->with('message', trans('profile.update'));
    }

    protected function validateForm(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'company'  => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    }
}
