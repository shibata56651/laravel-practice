<?php

namespace App\Http\Api\Requests\Admin;

use App\Http\Api\Requests\BaseRequest;

class ShowRequest extends BaseRequest
{
    /**
     * Determine if the operator is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'admin.id' => 'required|integer',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['admin']['id'] = $this->route('adminID', null); //クエリパラメータから取得

        return $data;
    }
}
