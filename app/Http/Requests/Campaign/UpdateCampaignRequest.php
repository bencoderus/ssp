<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $today = now();

        return [
            'name' => ['required', 'string'],
            'start_date' => ['required', "after_or_equal:{$today}"],
            'end_date' => ['required', "after_or_equal:{$today}", "after_or_equal:start_date"],
            'total_budget' => ['required', 'numeric', 'min:1', 'gte:daily_budget'],
            'daily_budget' => ['required', 'numeric', 'min:1', 'lte:total_budget'],
            'images' => ['required', 'array', 'min:1'],
            'image.*' => ['image', 'max:2000'],
        ];
    }
}
