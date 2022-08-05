<?php

namespace App\Http\Requests;

use App\Models\OprUnDelivery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreOprUnDeliveryRequest extends FormRequest
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
            'shipper' => ['required', 'string'],
            'no_awb' => ['required', 'string'],
            'date_inbound' => ['required', 'date'],
            'consignee' => ['required', 'string'],
            'consignee_addr' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'goods_desc' => ['required', 'string'],
            'undel_code' => ['required', 'string'],
            'undel_desc' => ['required', 'string'],
            'opr_customer_account_id' => ['required', 'integer'],
        ];
    }

    public function authenticate()
    {
        $data = OprUnDelivery::where('no_awb', $this->only('no_awb'))->first();
        if ($data) {
            throw ValidationException::withMessages([
                'no_awb' => trans('AWB Sudah Terinput'),
            ]);
        }
    }
}
