<?php

// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        return response()->json($portfolios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.name' => 'required|string|max:255',
            'data.title' => 'nullable|string|max:255',
            'data.description' => 'nullable|string',
            'data.avatar' => 'nullable|url',
            'data.links' => 'array|nullable',
            'data.links.*.label' => 'required|string',
            'data.links.*.url' => 'required|url',
            'data.experiences' => 'array|nullable',
            'data.experiences.*.role' => 'required|string',
            'data.experiences.*.company' => 'required|string',
            'data.experiences.*.period' => 'required|string',
            'data.experiences.*.description' => 'nullable|string',
            'data.education' => 'array|nullable',
            'data.education.*.course' => 'required|string',
            'data.education.*.institution' => 'required|string',
            'data.education.*.period' => 'required|string',
        ]);

        $portfolio = Portfolio::create([
            'user_id' => auth('api')->user()->id,
            'template_id' => $request->input('data.template_id', null),
            'data' => $request->input('data'),
        ]);

        return response()->json($portfolio, 201);
    }


    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'data' => 'required|array',
            'data.name' => 'required|string|max:255',
            'data.title' => 'nullable|string|max:255',
            'data.description' => 'nullable|string',
            'data.avatar' => 'nullable|url',
            'data.template_id' => 'nullable|integer|exists:templates,id',
            'data.links' => 'array|nullable',
            'data.links.*.label' => 'required|string',
            'data.links.*.url' => 'required|url',
            'data.experiences' => 'array|nullable',
            'data.experiences.*.role' => 'required|string',
            'data.experiences.*.company' => 'required|string',
            'data.experiences.*.period' => 'required|string',
            'data.experiences.*.description' => 'nullable|string',
            'data.education' => 'array|nullable',
            'data.education.*.course' => 'required|string',
            'data.education.*.institution' => 'required|string',
            'data.education.*.period' => 'required|string',
        ]);

        $portfolio->update([
            'data' => $validated['data'],
            'template_id' => $validated['data']['template_id'] ?? $portfolio->template_id,
        ]);

        return response()->json($portfolio);
    }
    public function destroy($id)
    {
        Portfolio::destroy($id);
        return response()->json(['message' => 'Portfólio deletado com sucesso!']);
    }
}

