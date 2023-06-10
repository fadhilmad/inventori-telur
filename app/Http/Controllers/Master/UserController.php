<?php

namespace App\Http\Controllers\Master;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('master-data.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        User::create($request->only(['name', 'username', 'password', 'role']));

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('master-data.user.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('master-data.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->filled('password')) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            User::find($user->id)->update($request->only(['name', 'username', 'password', 'role']));
        } else {
            User::find($user->id)->update($request->only(['name', 'username', 'role']));
        }


        Alert::toast('Data berhasil diubah', 'success');

        return redirect()->route('master-data.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::id()) {
            Alert::warning('Woops!', 'Tidak dapat menghapus akun anda sendiri.');

            return redirect()->route('master-data.user.index');
        }

        User::destroy($user->id);

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('master-data.user.index');
    }
}
