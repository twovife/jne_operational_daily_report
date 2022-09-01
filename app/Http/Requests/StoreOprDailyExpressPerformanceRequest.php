<?php

namespace App\Http\Requests;

use App\Models\OprDailyExpressPerformance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreOprDailyExpressPerformanceRequest extends FormRequest
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
            'inbound_date' => ['required', 'date'],
            'zone' => ['required', 'string'],
            'hub' => ['required', 'string'],
            'total_shipment_cod' => ['required', 'integer', 'min:0'],
            'total_nominal_cod' => ['required', 'integer', 'min:0'],
            'total_0' => ['required', 'integer', 'min:0'],
            'unrunsheet_0' => ['required', 'integer', 'min:0'],
            'delivered_0' => ['required', 'integer', 'min:0'],
            'cr_0' => ['required', 'integer', 'min:0'],
            'undel_0' => ['required', 'integer', 'min:0'],
            'open_0' => ['required', 'integer', 'min:0'],
            'wh_0' => ['required', 'integer', 'min:0'],
            'return_0' => ['required', 'integer', 'min:0'],
            'successreturn_0' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'delivered_0.min' => 'Delivered harus diatas 0',
            'delivered_0.required' => 'Delivered harus diisi',
            'delivered_0.integer' => 'Delivered harus angka',
            'total_0.min' => 'Total Cnote harus diatas 0',
            'total_0.required' => 'Total Cnote harus diisi',
            'total_0.integer' => 'Total Cnote harus angka',
            'unrunsheet_0.min' => 'Un Runsheet harus diatas 0',
            'unrunsheet_0.required' => 'Un Runsheet harus diisi',
            'unrunsheet_0.integer' => 'Un Runsheet harus angka',
            'cr_0.min' => 'CR harus diatas 0',
            'cr_0.required' => 'CR harus diisi',
            'cr_0.integer' => 'CR harus angka',
            'undel_0.min' => 'Undel harus diatas 0',
            'undel_0.required' => 'Undel harus diisi',
            'undel_0.integer' => 'Undel harus angka',
            'open_0.min' => 'Un Status harus diatas 0',
            'open_0.required' => 'Un Status harus diisi',
            'open_0.integer' => 'Un Status harus angka',
            'return_0.min' => 'Return harus diatas 0',
            'return_0.required' => 'Return harus diisi',
            'return_0.integer' => 'Return harus angka',
            'wh_0.min' => 'WH1 harus diatas 0',
            'wh_0.required' => 'WH1 harus diisi',
            'wh_0.integer' => 'WH1 harus angka',
            'successreturn_0.min' => 'Sukses Return harus diatas 0',
            'successreturn_0.required' => 'Sukses Return harus diisi',
            'successreturn_0.integer' => 'Sukses Return harus angka',
        ];
    }
    public function authenticate()
    {
        $data = OprDailyExpressPerformance::where('inbound_date', $this->only('inbound_date'))->where('zone', $this->only('zone'))->where('hub', $this->only('hub'))->first();
        if ($data) {
            throw ValidationException::withMessages([
                'inbound_date' => trans('Zona & Tanggal sudah terinput sebelumnya'),
            ])->redirectTo(route('opr.dailyperformance.express.edit', $data->id));
        }
    }
}
