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
