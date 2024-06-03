<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ModmeService
{
    private string $token;
    public string $modme_url;

    public function __construct(){
        $this->modme_url = config('app.modme_API_URL');
        $this->token = '';
    }
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function sendLead(array $data) :mixed
    {
        if (empty($this->token)) {
            throw new \Exception("Token is not set.");
        }
        try {
            $client = new Client();
            $post = $client->post($this->modme_url."/v1/leadData", [
                'query' => [
                    "name" => $data['name'],
                    "phone" => $data['phone'],
                    "branch_id" => $data['branch_id'],
                    "comment" => $data['comment'] ?? null,
                    "section_id" => $data['section_id'] ?? null,
                    "source_id" => $data['source_id'] ?? null,
                ],
                'headers' => [
//                    'Authorization' => 'Bearer '.$this->token,
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS5tb2RtZS5kZXYvdjEvYXV0aC9sb2dpbiIsImlhdCI6MTcxNzE1ODE0NiwiZXhwIjoxNzE3MjAxMzQ2LCJuYmYiOjE3MTcxNTgxNDYsImp0aSI6IlpBVVFLM2U4VFN0YVk5QjYiLCJzdWIiOiIxMzI4OTMiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.2CFLiqrfgCIfqAHLAwoOrM-jzys7UhqY5LUMYJ78QWM',
                    'Content-Type' => 'application/json',
                ]
            ]);
            return json_decode($post->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function checkToken(string $token) :mixed
    {
        try {
            $client = new Client();
            $post = $client->get($this->modme_url."/v2/token/me", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ]
            ]);
            return json_decode($post->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
