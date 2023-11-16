<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Companies;
use App\Models\Roles;

use App\Models\User;
use Illuminate\Routing\Route;

class UsersController extends Controller{
    public function index(){ 
        $users = User::all();
        // add la company et le role
        foreach($users as $user){
            $user->company = Companies::find($user->id_company);
            $user->role = Roles::find($user->id_role);
        }

        return Inertia::render('Admin/Users/Users', [
            'users' => $users,
        ]);
    }

    public function show($id){
        $user = User::find($id);
        $user->company = Companies::find($user->id_company);
        $user->role = Roles::find($user->id_role);
        $name = $user->getFullNameAttribute();

        return Inertia::render('Admin/Users/User', [
            'user' => $user,
            'name' => $name,
        ]);
    }

    public function create(){
        $companies = Companies::all();
        $roles = Roles::all();
        return Inertia::render('Admin/Users/Create', [
            'companies' => $companies,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'company' => 'required|exists:companies,id',
            'role' => 'required|exists:roles,id',
        ]);

        $password = User::generatePassword();

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'id_company' => $request->company,
            'id_role' => $request->role,
            'email' => $request->email,
            'password' => $password,
        ]);

        return Redirect::route('users');
    }

    public function edit($id){
        $user = User::find($id);
        $companies = Companies::all();
        $roles = Roles::all();
        $name = $user->getFullNameAttribute();

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'companies' => $companies,
            'roles' => $roles,
            'name' => $name,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|',
            'company' => 'required|exists:companies,id',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::find($id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->id_company = $request->company;
        $user->id_role = $request->role;
        $user->email = $request->email;

        $user->save();

        return Redirect::route('user.show', ['id' => $id]);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return Redirect::route('users');
    }
}
