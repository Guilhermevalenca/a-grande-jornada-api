<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function update_name(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'string']
        ]);
        auth()->user()->update([
            'name' => $validation['name']
        ]);

        return response(true, 200);
    }

    public function update_email(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email']
        ]);
        auth()->user()->update([
            'email' => $validation['email']
        ]);
        return response(true, 200);
    }

    public function update_password(Request $request)
    {
        $validation = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed']
        ]);
        auth()->user()->update([
            'password' => Hash::make($validation['password'])
        ]);

        return response(true, 200);
    }
}
