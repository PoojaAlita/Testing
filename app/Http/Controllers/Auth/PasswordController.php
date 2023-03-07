<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;


class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }


    /*Current Password*/
    public function current_password_validate(Request $request)
    {
        $user = User::find($request->id);
        if (Hash::check($request->current_password, $user->password)) {
            return false;
        } else {
            return true;
        }
    }

    /* New Password*/
    public function password_validate(Request $request)
    {
        if ($request->old_password != $request->password) {
            return false;
        } else {
            return true;
        }
    }


    /*Password Confirmation Validate*/
    public function password_confirmation_validate(Request $request)
    {
        if ($request->pwd_con == $request->password) {
            return false;
        } else {
            return true;
        }
    }
}
