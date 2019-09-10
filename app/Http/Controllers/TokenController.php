<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\GenerateTokenService;

class TokenController extends Controller
{
    protected $tokenService;


    /**
     * TokenController constructor.
     *
     * Setup the Generate Token Service
     *
     * @param GenerateTokenService $tokenService
     */
    public function __construct(GenerateTokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Generate a new token for user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function requestToken(Request $request)
    {
        return $this->tokenService->accessToken(["client_id" => $request->client_id, "client_secret" => $request->client_secret]);
    }

    /**
     * Generates new token for user using refresh token.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        return $this->tokenService->refreshToken($request->refresh_token);
    }


    /**
     * Destroys user token
     *
     * @param Request $request
     */
    public function revokeToken(Request $request)
    {
        $request->user()->token()->revoke();
    }

}
