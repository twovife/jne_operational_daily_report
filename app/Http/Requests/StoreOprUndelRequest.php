<?php

namespace App\Http\Requests;

use App\Models\OprArrivalBreach;
use App\Models\OprUndel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreOprUndelRequest extends FormRequest
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
        $data = OprUndel::where('no_awb', $this->only('no_awb'))->first();
        $data2 = OprArrivalBreach::where('no_awb', $this->only('no_awb'))->first();
        if ($data) {
            throw ValidationException::withMessages([
                'no_awb' => trans('AWB Terdeteksi Telah Terinput Pada Modul Undel'),
            ])->redirectTo(route('opr.undel.edit', $data->id));
        }

        if ($data2) {
            throw ValidationException::withMessages([
                'no_awb' => trans('AWB Terdeteksi Telah Terinput Pada Modul Arrival Breach'),
            ])->redirectTo(route('opr.breach.edit', $data2->opr_breach_id));
        }
    }
}
