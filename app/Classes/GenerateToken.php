<?php
namespace App\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GenerateTokenService
{
    /**
     * Generates access token using credentials
     *
     * @param  array  $credentials
     * @return \Illuminate\Http\Response
     */
    public function accessToken(array $credentials)
    {
        $url = url('api/v1/oauth/token');
        $client = new Client();

        $form_params = [
            'client_id' => $credentials["client_id"],
            'client_secret' => $credentials["client_secret"],
            'grant_type' => "client_credentials",
            'scope' => "*"
        ];

        $params_to_log = $form_params;
        unset($params_to_log['client_secret']);
        Log::info("Get token params: ". print_r($params_to_log,true));
        $response = $client->request('POST', $url, [
            'http_errors' => false,
            'form_params' => $form_params
        ]);
        Log::info("Get token response: ".print_r($response,true));

        return $response;
    }

    /**
     * Generates access token using refresh token
     *
     * @param string $refreshToken
     * @return \Illuminate\Http\Response
     */
    public function refreshToken($refreshToken)
    {

        $url = url('oauth/token');
        $client = new Client();

        $response = $client->request('POST', $url, [
            'http_errors' => false,
            'form_params' => [
                'client_id' => Config::get('oauth.passwordClientId'),
                'client_secret' => Config::get('oauth.passwordClientSecret'),
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,

            ]
        ]);

        return $response;
    }
}
