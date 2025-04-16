<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return response()->json($templates);
    }

    public function show($id)
    {
        $template = Template::findOrFail($id);
        return response()->json($template);
    }
}
