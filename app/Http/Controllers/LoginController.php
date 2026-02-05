<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Handle login for client, restaurateur, and admin users.
     * Login by email and password, then check role from database.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // First, try to login as a regular user (client or restaurateur)
        $loginAsUser = $this->loginUserByEmailPassword($email, $password);
        if ($loginAsUser) {
            return $loginAsUser;
        }

        // If not a regular user, try admin
        $loginAsAdmin = $this->loginAdminByEmailPassword($email, $password);
        if ($loginAsAdmin) {
            return $loginAsAdmin;
        }

        // If neither works, return error
        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput($request->except('password'));
    }

    /**
     * Login for regular users (client or restaurateur) by email and password.
     * Checks role from database after successful password verification.
     */
    private function loginUserByEmailPassword($email, $password)
    {
        // Find user by email using User model (not DB::table)
        $user = User::where('email', $email)->first();

        // If user not found or password doesn't match
        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        // Get user role from database
        $role = $user->role;

        if (!$role) {
            return redirect()->back()->withErrors([
                'email' => 'User role not assigned',
            ])->withInput();
        }

        // Login successful - authenticate the user
        Auth::login($user);

        // Redirect based on role description
        $roleDescription = strtolower($role->name);

        if ($roleDescription === 'client') {
            return redirect()->route('client.restaurants');
        } elseif ($roleDescription === 'restaurateur') {
            return redirect()->route('myRestaurant');
        }

        return redirect()->intended('dashboard');
    }

    /**
     * Login for Admin users by email and password.
     * Checks admin table.
     */
    private function loginAdminByEmailPassword($email, $password)
    {
        // Find admin by email
        $admin = Admin::where('email', $email)->first();

        // If admin not found or password doesn't match
        if (!$admin || !Hash::check($password, $admin->password)) {
            return null;
        }

        // Login successful
        Auth::guard('admin')->login($admin);

        return redirect()->intended('dashboard');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

