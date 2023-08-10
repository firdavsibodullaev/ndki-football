<?php

namespace App\Http\Requests\Season;

use App\DTOs\Season\SeasonDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'started_at' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                Rule::unique('seasons', 'started_at')
            ],
            'finished_at' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:started_at',
                Rule::unique('seasons', 'started_at')
            ]
        ];
    }

    public function toDto(): SeasonDTO
    {
        $payload = $this->validated();
        $payload['started_at'] = $payload['started_at']
            ? Carbon::createFromFormat('Y-m-d', $payload['started_at'])->startOfDay()
            : null;
        $payload['finished_at'] = $payload['finished_at']
            ? Carbon::createFromFormat('Y-m-d', $payload['finished_at'])->endOfDay()
            : null;

        return new SeasonDTO(...$payload);
    }
}
