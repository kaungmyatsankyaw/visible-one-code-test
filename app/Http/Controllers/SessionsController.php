<?php

namespace App\Http\Controllers;

use Str;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

       

        $user = User::where('phone', $request->get('phone'))->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => 'Your provided credentials could not be verified.'
            ]);
        }



        if (!auth()->attempt($attributes)) {

        }

        session()->regenerate();

        return redirect('/dashboard');

    }

    public function show()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function update()
    {

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
