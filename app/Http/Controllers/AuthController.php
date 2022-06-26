<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Use_;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:leaders,phone',
            'department' => 'required|string|max:5'
        ]);

        $leader = Leader::create([
            'name' => $fields['name'],
            'phone' => $fields['phone'],
            'department' => $fields['department']
        ]);

        $token = $leader->createToken('leadertoken')->plainTextToken;

        $response = [
            'leader' => $leader,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'phone' => 'required|string'
        ]);

        $leader = Leader::where('phone', $fields['phone'])->first();

        if (!$leader) {
            return response([
                'message' => 'bad credintials'
            ]);
        }

        $token = $leader->createToken('leadertoken')->plainTextToken;

        $response = [
            'leader' => $leader,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }
}
