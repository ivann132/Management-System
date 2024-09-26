<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:50',
            ], [
                'name.required' => 'NIM field is required',
                'email.required' => 'Email field is required',
                'email.email' => 'Please enter a valid email address',
                'email.unique' => 'Email has already been taken',
                'password.required' => 'Password field is required',
                'password.min' => 'Password must be at least 8 characters',
                'password.max' => 'Password may not be greater than 50 characters',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            return redirect('/#login')->with('success', 'Anda Berhasil Registrasi');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/#register')->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect('/#register')->withInput();
        }
    }
}
