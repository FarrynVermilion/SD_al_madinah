<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    protected $redirectTo = '/home';
    protected function register()
    {
        return view('users.createUsers');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','max:255'],
            'email' => ['required', 'string','email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        $data = $request->all();
        $check = $this->valid($data);
        return redirect('users.index')->with('success','Data Berhasil Ditambah');
    }

    protected function valid (array $data)
    {
        return User::create([
            'name' => ucwords(trim($data['name'])),
            'email' => trim($data['email']),
            'password' => Hash::make($data['password']),
            'role'=> $data['role'],
            'remember_token' => Str::random(25),
        ]);
    }

    public function index(User $model)
    {
        $users = User::orderBy('Name')->paginate(15);
        return view('users.index', compact('users'));
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('users.index')->with('success','Data Berhasil Dihapus');
    }
}
