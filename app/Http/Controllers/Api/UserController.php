<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return User::all();
        // return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myKeys')->plainTextToken;
        $responce = [
            'user' => $user,
            'token' => $token
        ];
        return response($responce, 201);
        // return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function login(Request $request)
    {
        // dd($request->all());

        $fields = $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::where('email', $fields['email'])->first();
        // dd($user['email']);
        // dd(!Hash::check($fields['password'], $user->password));

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad cred',
            ], 401);
        }
        $token = $user->createToken('myKeys')->plainTextToken;
        $responce = [
            'user' => $user,
            'token' => $token
        ];
        return response($responce, 201);
        // return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function show($id)
    {
        return User::find($id);
        // return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
        // return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function destroy($id)
    {
        return User::destroy($id);

        // return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function search($name)
    {
        return User::where('name', 'like', '%' . $name . '%')->get();

        // return view('users.index', ['users' => $model->paginate(15)]);
    }
}
