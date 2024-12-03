<?php

namespace App\Http\Middleware;

use App\Consts\Messages\ExceptionMessages;
use App\Exceptions\LineException;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $id_token = $request->cookie('idToken');

        // idTokenの存在を確認
        if (! $id_token) {
            throw new LineException(ExceptionMessages::IDTOKEN_NOT_FOUND);
        }

        // SSR の場合、トークンを復号
        if ($request->hasHeader('X-SSR')) {
            $id_token = Crypt::decryptString($id_token);
        }

        // JWTの形式かどうか確認
        $jwt_info = explode('.', $id_token);

        if (count($jwt_info) !== 3) {
            throw new LineException(ExceptionMessages::INVALID_IDTOKEN_FORMAT);
        }

        // ペイロード部分をデコード
        $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $jwt_info[1])), true);

        // exp キーが存在するか確認
        if (! isset($payload['exp'])) {
            throw new LineException(ExceptionMessages::EXPIRATION_NOT_FOUND);
        }

        $current_date_time = now();
        $expiration_date_time = Carbon::createFromTimestamp($payload['exp']);

        if ($expiration_date_time > $current_date_time) {
            $request->merge(['line_user_id' => $payload['sub']]);

            return $next($request);
        } else {
            throw new LineException(
                message: ExceptionMessages::IDTOKEN_EXPIRATION_MESSAGE,
                code: 460,
                log_level: LineException::LOG_LEVEL_INFO
            );
        }
    }
}
