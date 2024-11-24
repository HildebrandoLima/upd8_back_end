<?php

namespace App\Http\Requests\Client;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ClientRequest extends BaseRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.exists' => DefaultErrorMessages::NOT_FOUND,
            'client_id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'client_id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
