<?php

namespace App\Http\Requests\Representative;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\StateEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateRepresentativeRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:representative,name',
            'cnpj' => 'string|min:18|max:18|unique:representative,cnpj',
            'address' => 'required|string',
            'state' => 'required|string|in:' . implode(',', array_map(fn($case) => $case->value, StateEnum::cases())),
            'city_name' => 'required|string',
            'clients' => 'required|array',
            'clients.*' => 'required|int|exists:client,id',
        ];
    }

    public function messages(): array
    {
        return [
            'state.in' => DefaultErrorMessages::NOT_FOUND,
            'clients.*.exists' => DefaultErrorMessages::NOT_FOUND,

            'name.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'cnpj.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'cnpj.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'cnpj.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'name.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'address.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'state.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'city_name.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'clients.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'address.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'state.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'city_name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'clients.string' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'clients.*.int' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
