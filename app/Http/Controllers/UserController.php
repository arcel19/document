<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $users = User::orderByDesc('id')->get();
        \App\Models\User::logUserActivity('A consulte  la liste des utilisateurs');

        return view('pages.user' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'phone'=>$request->phone,

        ]);
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //         'password' => ['required', 'string', 'min:8'],
        //         'phone' => ['required', 'string', 'numeric'],
        //     ]);
            // $user = new User();
            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->password = Hash::make($request->password);
            // $user->phone = $request->phone;
            // $user->save();

            $u = User::findOrFail($user->id);
            $user_type = $request->user_type;
    switch ($user_type) {
        case 'Admin':

            $u->user_type = 'Admin';
            $u->save();

            $admin = new Admin();
            $admin->user_id = $u->id;

            $admin->save();
            break;

        case 'Teacher':

            $u->user_type = 'Teacher';
            $u->save();

            $m = new Teacher();
            $m->user_id = $u->id;

            $m->save();
            break;

        case 'Etudiant':
            $u->user_type = 'Etudiant';
            $u->save();

            $s = new Etudiant();
            $s->user_id = $u->id;
            $s->save();
            break;

        default:
            die('Oups !! error Please check your configuration');
    }
    \App\Models\User::logUserActivity('A creer l'. 'utilisateur' . $user->name);

    return redirect()->route('user.index')->with('message', 'user created');
    }


    public function state( Request $request, User $user){
        $user->state = $request->state == 1;
        $user->save();
        \App\Models\User::logUserActivity('A changer l'.'etat' . 'de l'. 'utilisateur'. $user->name);

        session()->flash('success', 'Opération réussie !');
        return redirect()->route('user.index')->with('session', 'L\'utilisateur a été mis à jour avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully');
    }

    public function logIndex()
    {
        return view('pages.log');
    }
}
