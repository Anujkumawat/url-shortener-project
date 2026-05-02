<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    // SuperAdmin → Admin + Company
    public function inviteAdmin(Request $request)
    {
        $authUser = auth()->user();

        if (!$authUser->hasRole('superadmin')) {
            abort(403, 'Only SuperAdmin can create Admin');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = "12345678";

        // Company create
        $company = Company::firstOrCreate([
            'name' => $request->name
        ]);

        // Admin create
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password),
            'company_id' => $company->id,
        ]);

        $user->assignRole('admin');

        // Mail
        Mail::html(
            "<h3>You are invited as Admin</h3>
            <p>Email: {$user->email}</p>
            <p>Password: {$password}</p>
            <p><a href='" . url('/login') . "'>Login</a></p>",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Admin Invitation');
            }
        );

        return redirect()->back()->with('success', 'Invitation sent successfully!');
    }

    // Admin → Member
    public function inviteMember(Request $request)
    {
        $authUser = auth()->user();

        if (!$authUser->hasRole('admin')) {
            abort(403, 'Only Admin can create Member');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = "12345678";

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password),
            'company_id' => $authUser->company_id,
        ]);

        $user->assignRole('member');

        // Mail
        Mail::html(
            "<h3>You are invited as Member</h3>
            <p>Email: {$user->email}</p>
            <p>Password: {$password}</p>
            <p><a href='" . url('/login') . "'>Login</a></p>",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Member Invitation');
            }
        );

        return redirect()->back()->with('success', 'Invitation sent successfully!');
    }
}
