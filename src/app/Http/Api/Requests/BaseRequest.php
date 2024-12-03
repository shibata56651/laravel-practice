<?php

namespace App\Http\Api\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class BaseRequest extends FormRequest
{
    public function all($keys = null)
    {
        $requestData = parent::all($keys);
        $this->prepareForValidation();

        return $requestData;
    }

    private function decodeJson($jsonString)
    {
        if (! is_string($jsonString)) {
            return $jsonString;
        }
        $decoded = json_decode($jsonString, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }

        return $decoded;
    }

    protected function prepareForValidation()
    {
        $data = [];
        $this->merge($data);
    }

    public function rules()
    {
        return [
            'filter' => 'sometimes|array',
            'sort_key' => 'sometimes|string',
            'sort_type' => 'sometimes|in:ASC,DESC',
            'pagination.page' => 'sometimes|integer|min:1',
            'pagination.perPage' => 'sometimes|integer|min:1|max:100',
            'limit' => 'sometimes|integer|min:1|max:100',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'summary' => 'エラーが発生しました',
            'status' => 422,
            'errors' => $validator->errors()->toArray(),
            'data' => $this->request->all(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw new HttpResponseException($response);
    }
}
