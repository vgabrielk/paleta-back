<?php

namespace App\Http\Services;
use App\Models\Template;

class TemplateService
{

    public static function getTemplate()
    {
        return Template::select('name', 'type')->get();
    }

    public function get($id)
    {
        return Template::findOrFail($id);
    }
}
