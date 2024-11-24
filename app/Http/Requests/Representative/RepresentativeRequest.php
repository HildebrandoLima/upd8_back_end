<?php

namespace App\Http\Requests\Representative;

use App\Domain\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;

class RepresentativeRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
