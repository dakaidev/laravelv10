<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\UserType;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Office;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function manageUsers()
    {
        $users = User::with('userType', 'office')->get();
        return view('admin.manage_users', compact('users'));
    }

    public function createUser()
    {
        $user_types = UserType::all();
        $offices = Office::all();
        return view('admin.create_user', compact('user_types', 'offices'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type_id' => 'required|exists:user_types,id',
            'office_id' => 'nullable|exists:offices,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type_id,
            'office_id' => $request->office_id,
        ]);

        return redirect()->route('admin.manage_users')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        $user_types = UserType::all();
        $offices = Office::all();
        return view('admin.edit_user', compact('user', 'user_types', 'offices'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'user_type_id' => 'required|exists:user_types,id',
            'office_id' => 'nullable|exists:offices,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type_id' => $request->user_type_id,
            'office_id' => $request->office_id,
        ]);

        return redirect()->route('admin.manage_users')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.manage_users')->with('success', 'User deleted successfully');
    }

    public function viewOfficeDocumentsCount()
    {
        $offices = Office::withCount('documents')->get();
        return view('admin.office_documents_count', compact('offices'));
    }
}