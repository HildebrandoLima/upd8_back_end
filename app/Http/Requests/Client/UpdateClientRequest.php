<?php

namespace App\Http\Requests\Client;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class UpdateClientRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:client,id',
			'address' => 'required|string',
            'city_id' => 'required|int',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'address.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'city_id.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'address.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'city_id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
