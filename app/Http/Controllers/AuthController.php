<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
  
class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }
  
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])/',
                Password::min(8)
            ]
        ], [
            'email.unique' => 'This email is already registered.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
  
    public function login()
    {
        return view('auth.admin-login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/login');
    }
 
    public function profile()
    {
        return view('profile');
    }

    /**
     * Show the change password form.
     */
    public function showChangePasswordForm()
    {
        return view('change-password');
    }

    /**
     * Change the user's password.
     */
    public function changePassword(Request $request)
    {
        Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                'different:current_password',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])/',
                Password::min(8)
            ]
        ], [
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'new_password.different' => 'The new password must be different from your current password.'
        ])->validate();

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    /**
     * Update the user's profile.
     */
    public function updateProfile(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ])->validate();

        $user = Auth::user();
        $user->name = $request->name;
        
        // Only update email if it's changed
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }
        
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    //Employee Auth functions
    public function employeeLogin()
    {
        return view('auth.employee-login');
    }

    public function employeeLoginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if(!Auth::guard('employee')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard.employee');
    }
}