<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('inventory', ['read', 'write']);

            return response()->json(['api_token' => $token->plainTextToken]);
        }

        return response()->json(['error' => 'Invalid login credentials'], 401);
    }

    /** Display a listing of the resource. */
    public function index(): \Illuminate\Http\Response
    {
    }

    /** Store a newly created resource in storage. */
    public function store(Request $request): \Illuminate\Http\Response
    {
    }

    /** Display the specified resource. */
    public function show(int $id): \Illuminate\Http\Response
    {
    }

    /** Update the specified resource in storage. */
    public function update(Request $request, int $id): \Illuminate\Http\Response
    {
    }

    /** Remove the specified resource from storage. */
    public function destroy(int $id): \Illuminate\Http\Response
    {
    }
}
