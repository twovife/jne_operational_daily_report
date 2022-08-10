<?php

namespace App\Http\Requests;

use App\Models\OprDailyPerformance;
use App\Models\OprDailyPerformanceDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreOprDailyPerformanceRequest extends FormRequest
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
            'ur_0' => ['required', 'integer', 'min:0'],
            'd_0' => ['required', 'integer', 'min:0'],
            'cr_0' => ['required', 'integer', 'min:0'],
            'u_0' => ['required', 'integer', 'min:0'],
            'o_0' => ['required', 'integer', 'min:0'],
            'r_0' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'd_0.min' => 'Delivered harus diatas 0',
            'd_0.required' => 'Delivered harus diisi',
            'd_0.integer' => 'Delivered harus angka',
            'total_0.min' => 'Total Cnote harus diatas 0',
            'total_0.required' => 'Total Cnote harus diisi',
            'total_0.integer' => 'Total Cnote harus angka',
            'ur_0.min' => 'Un Runsheet harus diatas 0',
            'ur_0.required' => 'Un Runsheet harus diisi',
            'ur_0.integer' => 'Un Runsheet harus angka',
            'cr_0.min' => 'CR harus diatas 0',
            'cr_0.required' => 'CR harus diisi',
            'cr_0.integer' => 'CR harus angka',
            'u_0.min' => 'Undel harus diatas 0',
            'u_0.required' => 'Undel harus diisi',
            'u_0.integer' => 'Undel harus angka',
            'o_0.min' => 'Un Status harus diatas 0',
            'o_0.required' => 'Un Status harus diisi',
            'o_0.integer' => 'Un Status harus angka',
            'r_0.min' => 'Return harus diatas 0',
            'r_0.required' => 'Return harus diisi',
            'r_0.integer' => 'Return harus angka',
        ];
    }
    public function authenticate()
    {
        $data = OprDailyPerformance::where('inbound_date', $this->only('inbound_date'))->where('zone', $this->only('zone'))->where('hub', $this->only('hub'))->first();
        if ($data) {
            throw ValidationException::withMessages([
                'inbound_date' => trans('Zona & Tanggal sudah terinput'),
            ]);
        }
    }
}
