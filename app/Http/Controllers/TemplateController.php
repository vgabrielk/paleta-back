<?php

namespace App\Http\Controllers;

use App\Http\Services\TemplateService;

class TemplateController extends Controller
{

    protected TemplateService $templateService;
    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }
    public function index()
    {
        return $this->templateService->getTemplate();
    }

    public function show($id)
    {
        return $this->templateService->get($id);
    }
}
