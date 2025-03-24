<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterResource;
use App\Models\Auth;
use App\Models\User;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $authUser = new Auth();
        $authUser->user()->associate($user);
        $authUser->token = hash('sha256', $plainTextToken = Str::random(40));
        $authUser->active = true;
        $authUser->save();

        return (new RegisterResource($user))->response()->setStatusCode(201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::where('email', '=' , $data['email'])->firstOrFail();
        if(!Hash::check($data['password'], $user->password)) {
            return response()->json(['massage' => 'password is wrong'], 401);
        }
        $authUser = new Auth();
        $authUser->user()->associate($user);
        $authUser->token = hash('sha256', $plainTextToken = Str::random(40));
        $authUser->active = true;
        $authUser->save();

        return (new RegisterResource($user))->response()->setStatusCode(201);
    }

    public function logout(Request $request): JsonResponse {
        $data = $request->validate([
            'token' => ['required', 'string'],
        ]);

        $authUser = Auth::where('token', '=' , $data['token'])->firstOrFail();
        $authUser->active = false;
        $authUser->save();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function closeAllSessions(Request $request): JsonResponse
    {
        $data = $request->validate([
            'token' => ['required', 'string'],
        ]);

        $authUser = Auth::where('token', '=' , $data['token'])->firstOrFail();
        $allSessions = Auth::where('active', '=', true)->where('user_id', '=', $authUser->user_id)->update(['active' => false]);
        return response()->json(['message' => 'all sessions closed'], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
