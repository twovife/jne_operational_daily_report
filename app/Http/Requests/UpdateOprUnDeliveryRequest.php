<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOprUnDeliveryRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'no_awb' => ['required', 'string'],
            'origin' => ['required', 'string'],
            'origin' => ['required', 'string'],
            'shipper' => ['required', 'integer'],
            'consignee' => ['required', 'string'],
            'consignee_addr' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'goods_desc' => ['required', 'string'],
            'undel_code' => ['required', 'string'],
            'undel_desc' => ['required', 'string'],
            'date_inbound' => ['required', 'date'],
        ];
    }
}
