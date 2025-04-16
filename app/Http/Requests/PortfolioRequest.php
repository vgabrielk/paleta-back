<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
        ];
    }
}
