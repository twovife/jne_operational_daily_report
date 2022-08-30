<?php

namespace App\Http\Requests;

use App\Models\OprOpenStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreOprOpenStatusRequest extends FormRequest
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
            'date' => ['required'],
            'hub' => ['required'],
            'ttl_runsheet' => ['required']
        ];
    }

    public function authenticate()
    {
        $data = OprOpenStatus::where('date', $this->only('date'))->where('hub', $this->only('hub'))->first();
        if ($data) {
            throw ValidationException::withMessages([
                'date' => trans('data tanggal ini sudah terinput'),
            ]);
        }
    }
}
