<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // index
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('users.index', compact('users'));
    }

    // create
    public function create()
    {
        return view('users.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|min:6'
        ]);

        User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created');
    }

    // show
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // update
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
           'name' => 'required|string|max:255',
           'email' => "required|email|unique:users,email,$id",
           'password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated');
    }

    // destroy
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}
