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
    public function edit(User $user)
    {
        return view('users.edit')->with('edit', $user);
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string','max:255'],
            'email' => ['required', 'string','email'],
            'role' => ['required']
        ]);
        $user->update([
            "name" => $validated['nama'],
            "email" => $validated['email'],
            "role" => $validated['role']
        ]);
        return redirect()->route('user.index')->with('success','Data Berhasil Diubah');
    }
    public function passwordEdit(request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],

        ], [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sesuai',
            'password_confirmation.required' => 'Password wajib diisi',
            'password_confirmation.min' => 'Password minimal 8 karakter',
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index')->with('success','Password Berhasil Diubah');;
    }
}
