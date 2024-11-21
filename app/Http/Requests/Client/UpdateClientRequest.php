<?php

namespace App\Http\Requests\Client;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\StateEnum;
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
            'client_id' => 'required|int|exists:client,id',
            'city_id' => 'required|int|exists:city,id',
            'address' => 'required|string',
            'state' => 'required|string|in:' . implode(',', array_map(fn($case) => $case->value, StateEnum::cases())),
            'city_name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.exists' => DefaultErrorMessages::NOT_FOUND,
            'city_id.exists' => DefaultErrorMessages::NOT_FOUND,
            'state.in' => DefaultErrorMessages::NOT_FOUND,

            'client_id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'city_id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'address.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'state.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'city_name.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'client_id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'city_id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'address.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'state.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'city_name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
