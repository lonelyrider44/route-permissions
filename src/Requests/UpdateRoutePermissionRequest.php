<?php

namespace LR\Route\Permissions\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoutePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permission_name' => 'nullable',
            'permission_group_name' => 'nullable'
        ];
    }
}
