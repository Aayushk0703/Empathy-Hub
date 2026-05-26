<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null && $this->user()->hasAnyRole(['Admin', 'Staff']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'is_all_day' => ['nullable', 'boolean'],
            'location' => ['nullable', 'string', 'max:255'],
            'event_type' => ['required', 'string', 'max:50'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_all_day' => $this->boolean('is_all_day'),
            'event_type' => $this->input('event_type', 'general'),
        ]);
    }
}
