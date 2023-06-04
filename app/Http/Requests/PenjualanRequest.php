<?php

namespace App\Http\Requests;

use App\Traits\ReturnResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PenjualanRequest extends FormRequest
{
    use ReturnResponser;

    /** Penjualan
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'kendaraan_id' => 'required|string',
                    'customer_id' => 'required|string',
                    'tanggal' => 'required|date',
                    'jumlah_terjual' => 'required|integer',
                    'tipe_pembayaran' => 'required|string',
                ];
                break;
            case 'PUT':
                return [
                    'kendaraan_id' => 'sometimes|required|integer',
                    'customer_id' => 'sometimes|required|integer',
                    'tanggal' => 'sometimes|required|date',
                    'jumlah_terjual' => 'sometimes|required|integer',
                    'tipe_pembayaran' => 'sometimes|required|string',
                ];
                break;
            default:
                break;
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorvalidator($validator->errors()->first()));
    }
}
