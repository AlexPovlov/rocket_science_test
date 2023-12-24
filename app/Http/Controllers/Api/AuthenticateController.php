<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    function __invoke(AuthenticateRequest $request)
    {
        $validated = $request->validated();
        $user = User::wherePhone($validated['login'])
            ->orWhereEmail($validated['login'])
            ->first();

        if ($user and Hash::check($validated['password'], $user->password)) {
            $token = $user->createToken('token');
            return response()->success(['token' => $token->plainTextToken], "Авторизация успешна");
        }

        return response()->error([], "Не верный логин или пароль", 422);
    }
}
