<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $user = User::whereNull('deleted_at')->get();
        $data = [
            'session' => session('user'),
            'user' => $user,
        ];
        return view('user.user', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'session' => session('user'),
        ];
        return view('user.add_user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->username = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('akses');
        $user->save();

        return redirect(url('/user'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = [
            'session' => session('user'),
            'user' => $user
        ];
        return view('user.edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('akses');
        $user->update();

        return redirect(url('/user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(url('/user'));
    }
}
