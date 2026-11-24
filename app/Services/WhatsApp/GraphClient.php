<?php

namespace App\Services\WhatsApp;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * Calls to the WhatsApp Cloud API (graph.facebook.com). Each call returns
 * ['status', 'body', 'request']; 'request' is shown in the admin page's
 * request log, so tokens, secrets and codes are masked in it.
 */
class GraphClient
{
    private const SECRET_PARAMS = '/(access_token|client_secret|code|input_token)=[^&\s]+/';

    /**
     * @param  string|null  $token  null = WA_ACCESS_TOKEN, '' = no Authorization header
     */
    public function call(string $method, string $path, array $query = [], ?array $body = null, ?string $token = null): array
    {
        $token ??= (string) config('services.whatsapp.access_token');
        $url = sprintf('https://graph.facebook.com/%s/%s', config('services.whatsapp.graph_version'), ltrim($path, '/'));
        if ($query !== []) {
            $url .= '?'.http_build_query($query);
        }

        $request = Http::acceptJson()->timeout(25);
        if ($token !== '') {
            $request = $request->withToken($token);
        }

        try {
            $response = $request->send($method, $url, $body === null ? [] : ['json' => $body]);
            $status = $response->status();
            $decoded = $response->json() ?? ['raw' => $response->body()];
        } catch (ConnectionException $exception) {
            $status = 0;
            $decoded = ['error' => ['message' => 'Network error: '.self::mask($exception->getMessage())]];
        }

        return [
            'status' => $status,
            'body' => $decoded,
            'request' => ['method' => $method, 'url' => self::mask($url), 'body' => $body],
        ];
    }

    /** The error of a call, or null when it succeeded. */
    public static function error(array $response): ?string
    {
        $error = $response['body']['error'] ?? null;
        if ($response['status'] >= 200 && $response['status'] < 300 && ! $error) {
            return null;
        }

        return $error['error_user_msg'] ?? $error['message'] ?? 'HTTP '.$response['status'];
    }

    private static function mask(string $text): string
    {
        return preg_replace(self::SECRET_PARAMS, '$1=***', $text);
    }
}
