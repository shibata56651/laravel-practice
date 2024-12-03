<?php

namespace App\Http\Api\Responses;

use Illuminate\Http\JsonResponse;

interface BaseResponseInterface
{
    /**
     * 子クラスで実装するための抽象メソッド
     *
     * @param  int  $status  HTTPステータスコード
     */
    public function response(int $status, array $data): JsonResponse;
}
