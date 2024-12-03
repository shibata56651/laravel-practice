<?php

namespace App\Http\Api\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class BaseResponse implements BaseResponseInterface
{
    protected $data;

    protected $pagination;

    // Data getter and setter
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * 子クラスで実装するための抽象メソッド
     *
     * @param  int  $status  HTTPステータスコード
     */
    abstract public function response(int $status = Response::HTTP_OK, array $data = []): JsonResponse;

    /**
     * 共通レスポンス構造
     *
     * @param  int  $status  HTTPステータスコード
     */
    protected static function getResponse(int $status = Response::HTTP_OK, array $data = []): JsonResponse
    {
        $response = [
            'data' => $data,
        ];

        return response()->json($response, $status);
    }

    /**
     * 共通レスポンス(post)構造
     *
     * @param  int  $status  HTTPステータスコード
     */
    protected static function postResponse(int $status = Response::HTTP_OK, array $data = []): JsonResponse
    {
        return response()->json($data, $status);
    }
}
