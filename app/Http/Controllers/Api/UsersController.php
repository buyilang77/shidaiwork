<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\UserRequest;
use App\Models\Merchant;
use Auth;
use Illuminate\Http\JsonResponse;

/**
 * Class UsersController
 * @package App\Http\Controllers\Merchant
 */
class UsersController extends Controller
{

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $item = $request->validated();
        $item['password'] = bcrypt($item['password']);
        $user = new Merchant($item);
        $user->save();
        return $this->respondWithToken(Auth::login($user))->setStatusCode(201);
    }

    /**
     * @return JsonResponse
     */
    public function mine(): JsonResponse
    {
        $user = $this->user();
        return custom_response($user);
    }

    public function update(UserRequest $request)
    {
        $attributes = $request->only(['name', 'surname', 'phone', 'sex']);
        $this->user()->update($attributes);
        return custom_response($this->user());
    }
}
