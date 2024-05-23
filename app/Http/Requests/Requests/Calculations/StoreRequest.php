<?php

namespace App\Http\Requests\Requests\Calculations;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'calculation' => array(
                'required',
                'regex:/^\s*\d+(\.\d+)?\s*[\+\-\*\/]\s*\d+(\.\d+)?\s*$/'
            )
        ];
    }
}
