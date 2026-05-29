<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index() {
        $users = User::get();
        $activeUsers = User::where('status', 'active')->get();
        $blockedUsers = User::where('status', 'blocked')->get();
        $admins = User::where('is_admin', 1)->get();
        return view('admin.user.index', compact('users', 'activeUsers', 'blockedUsers', 'admins'));
    }

    public function toggleUser($id) { // toggle user status in user table
        $user = User::findOrFail($id);
        if($user->id === auth()->id()) {
            return back()->with('error', "You can not block user account!");
        } else {
            $user->status = $user->status === 'active' ? 'blocked' : 'active'; // if user is active then block if user is blick then active
            $user->save();
            return back();
        }
    }

    public function search(Request $request)
    {
        $query = User::query();

        // search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // role filter
        if ($request->is_admin !== null && $request->is_admin !== '') {
            $query->where('is_admin', $request->is_admin);
        }

        // status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->get();

        return view('partials.userTable', compact('users'));
    }

}
