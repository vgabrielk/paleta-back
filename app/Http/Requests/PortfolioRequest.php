<?php

namespace App\Http\Requests;

use App\Enums\SiteStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'data' => 'required|array',
            'data.name' => 'required|string|max:255',
            'data.title' => 'required|string|max:255',
            'data.description' => 'required|string',
            'data.site_url' => 'nullable|string|max:25',
            'data.site_status' => ['nullable', 'string', Rule::in(SiteStatus::values())],
            'data.avatar' => 'nullable|url',
            'data.links' => 'array|nullable',
            'data.links.*.label' => 'nullable|string',
            'data.links.*.url' => 'nullable|url',
            'data.experiences' => 'array|nullable',
            'data.experiences.*.role' => 'nullable|string',
            'data.experiences.*.company' => 'nullable|string',
            'data.experiences.*.period' => 'nullable|string',
            'data.experiences.*.description' => 'nullable|string',
            'data.education' => 'array|nullable',
            'data.education.*.course' => 'nullable|string',
            'data.education.*.institution' => 'nullable|string',
            'data.education.*.period' => 'nullable|string',
            'data.skills' => 'array|nullable',
            'data.skills.*.title' => 'nullable|string',
            'data.skills.*.short_description' => 'nullable|string',
            'template_type' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'data.required' => 'O campo "data" é obrigatório.',
            'data.array' => 'O campo "data" deve ser um array.',

            'data.name.required' => 'O nome é obrigatório.',
            'data.name.string' => 'O nome deve ser um texto.',
            'data.name.max' => 'O nome não pode ter mais que 255 caracteres.',

            'data.title.string' => 'O título deve ser um texto.',
            'data.title.max' => 'O título não pode ter mais que 255 caracteres.',

            'data.description.string' => 'A descrição deve ser um texto.',

            'data.avatar.url' => 'A URL do avatar deve ser válida.',

        ];
    }
}
