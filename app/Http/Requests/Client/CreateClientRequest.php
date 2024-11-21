<?php

namespace App\Http\Requests\Client;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\SexEnum;
use App\Support\Enums\StateEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateClientRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:client,name',
            'cpf' => 'string|min:14|max:14|unique:client,cpf',
            'address' => 'required|string',
            'date_birth' => 'required|date|before:' . now()->format('d-m-Y'),
            'sex' => 'required|string|in:' . SexEnum::MASCULINO . ',' . SexEnum::FEMININO,
            'state' => 'required|string|in:' . implode(',', array_map(fn($case) => $case->value, StateEnum::cases())),
            'city_name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'sex.in' => DefaultErrorMessages::NOT_FOUND,
            'state.in' => DefaultErrorMessages::NOT_FOUND,
            'date_birth.before' => 'Data de nascimento não pode ser hoje ou uma data futura.',

            'name.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'cpf.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'cpf.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'cpf.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'name.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'address.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'date_birth.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'sex.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'state.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'city_name.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cpf.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'address.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'date_birth.date' => DefaultErrorMessages::INVALID_DATE,
            'sex.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'state.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'city_name.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
