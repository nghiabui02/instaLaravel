<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function update($id, Request $request)
    {
        $validation = $request->validate([
            'name' => 'string|max:255',
            'username' => 'string|max:255|unique:users',
            'password' => 'string|min:6',
            'email' => 'string|email|max:255|unique:users',
            'avatar' => 'string'
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update($validation);
    }
}
