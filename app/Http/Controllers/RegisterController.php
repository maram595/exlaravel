<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
            'role' => 'author',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('posts.index');
    }
}