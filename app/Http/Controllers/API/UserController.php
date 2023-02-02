<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|unique',
            'password'  => 'required|password',
            'avatar'    => 'image'
        ]);

        $newUser = new User([
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
            'avatar'    => $request->get('avatar'),
            'role_id'   => $request->get('role_id')
        ]);

        $newUser->save();

        return response()->json($newUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email'     => 'required|email|unique',
            'password'  => 'required|password',
            'avatar'    => 'image'
        ]);

        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->avatar = $request->get('avatar');
        $user->role_id = $request->get('role_id');

        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json($user::all());
    }
}
