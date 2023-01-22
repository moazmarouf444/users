<?php

namespace App\Http\Requests\Api\Users;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class Store extends BaseApiRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'bio' => 'required|min:6',
            'file_name' => 'required_if:type,==,second|max:50',
            'file' => 'required_if:type,==,second',
            'lat' => 'required_if:type,==,third|min:6|max:100',
            'lng' => 'required_if:type,==,third|min:6|max:100',
            'address' => 'required_if:type,==,third|min:6|max:100',
            'date_birth' => 'required_if:type,==,third|date|date_format:Y-m-d|before:today',
            'type' => 'required|in:first,second,third',
        ];
    }
}
