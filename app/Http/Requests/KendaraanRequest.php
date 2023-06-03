<?php

namespace App\Http\Requests;

use App\Traits\ReturnResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class KendaraanRequest extends FormRequest
{
    use ReturnResponser;

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
        switch ($this->method()) {
            case 'POST':
                return [
                    'stok' => 'required|integer',
                    'jenis' => 'required|in:motor,mobil|string',
                    'attribute' => 'required_with:jenis|array',
                    'attribute.tipe_suspensi' => 'required_if:jenis,motor|string',
                    'attribute.mesin' => 'required_with:jenis|string',
                    'attribute.tipe_transmisi' => 'required_if:jenis,motor|string',
                    'attribute.kapasitas_penumpang' => 'required_if:jenis,mobil|integer',
                    'attribute.tipe' => 'required_if:jenis,mobil|string',
                ];
                break;
                case 'PUT':
                    return [
                        'stok' => 'sometimes|required|integer',
                        'jenis' => 'sometimes|required|in:motor,mobil|string',
                        'attribute' => 'sometimes|required_with:jenis|array',
                        'attribute.tipe_suspensi' => 'required_if:jenis,motor|string',
                        'attribute.mesin' => 'required_with:jenis|string',
                        'attribute.tipe_transmisi' => 'required_if:jenis,motor|string',
                        'attribute.kapasitas_penumpang' => 'required_if:jenis,mobil|integer',
                        'attribute.tipe' => 'required_if:jenis,mobil|string',
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
