<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\WeappAuthorizationRequest;
use Illuminate\Auth\AuthenticationException;

class AuthorizationsController extends Controller
{
    public function weappStore(WeappAuthorizationRequest $request)
    {
        $code = $request->code;
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if(isset($data['errcode'])) {
            throw new AuthenticationException('code不正确');
        }

        $user = User::where('weapp_openid', $data['openid'])->first();

        if(!$user) {
            $user = User::create([
                'nick_name' => $request->nick_name,
                'avatar' => $request->avatar,
                'weapp_openid' => $data['openid'],
                'weapp_session_key' => $data['session_key'],
            ]);
        } else {
            $user->update(['weapp_session_key' => $data['session_key']]);
        }

        $token = auth('api')->login($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL()*60
        ]);
    }

    public function update()
    {
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        auth('api')->logout();
        return response(null, 204);
    }
}
