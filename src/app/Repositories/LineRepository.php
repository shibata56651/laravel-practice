<?php

namespace App\Repositories;

use App\Consts\Messages\ExceptionMessages;
use App\Domain\Entities\LineProfile;
use App\Exceptions\LineException;
use Exception;
use Illuminate\Support\Facades\Http;

class LineRepository implements LineRepositoryInterface
{
    public function verifyIdToken(string $token): LineProfile
    {
        try {
            $response = Http::asForm()->post('https://api.line.me/oauth2/v2.1/verify', [
                'id_token' => $token,
                'client_id' => env('LINE_CHANNEL_ID'),
            ]);
        } catch (Exception $e) {
            throw new LineException(previous: $e);
        }
        if (isset($response['error_description'])) {
            if ($response['error_description'] === 'IdToken expired.') {
                throw new LineException(message: ExceptionMessages::IDTOKEN_EXPIRATION_MESSAGE, code: 460, log_level: LineException::LOG_LEVEL_INFO);
            } else {
                throw new LineException(ExceptionMessages::LINE_LOGIN_FAILED);
            }
        }

        return new LineProfile([
            'user_id' => $response['sub'],
            'channel_id' => $response['aud'],
            'name' => $response['name'],
            'expires_in' => $response['exp'],
        ]);
    }
}
