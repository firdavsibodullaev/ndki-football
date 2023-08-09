<?php

namespace App\Http\Requests\Game;

use App\DTOs\Game\GameDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

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
            'started_at' => 'required|date|date_format:Y-m-d',
            'finished_at' => 'required|date|date_format:Y-m-d',
            'days' => 'required|array',
            'days.*' => 'required|int|min:1|max:7'
        ];
    }

    public function toDto(): GameDTO
    {
        $payload = $this->validated();
        $payload['started_at'] = Carbon::createFromFormat('Y-m-d', $payload['started_at'])->startOfDay();
        $payload['finished_at'] = Carbon::createFromFormat('Y-m-d', $payload['finished_at'])->endOfDay();

        return new GameDTO(...$payload);
    }
}
