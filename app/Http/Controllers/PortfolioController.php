<?php

// app/Http/Controllers/PortfolioController.php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePortfolioRequest;
use App\Http\Requests\PortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Models\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        return response()->json($portfolios);
    }

    public function store(PortfolioRequest $request)
    {
        $validated = $request->validated();

        $template = Template::where('type', $validated['template_type'])->first();

        $portfolio = Portfolio::create([
            'user_id' => auth('api')->user()->id,
            'data' => $request->input('data'),
            'template_id' => $template->id,
        ]);

        return response()->json($portfolio, 201);
    }


    public function show($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $validated = $request->validated();

        if (!empty($validated['template_type'])) {
            $template = Template::where('type', $validated['template_type'])->first();
            if ($template) {
                $portfolio->template_id = $template->id;
            }
        }

        if (!empty($validated['data'])) {

            $portfolio->data = $validated['data'];
            $portfolio->user_id = auth('api')->user()->id;
        }

        $portfolio->save();

        return response()->json($portfolio);
    }
    public function destroy($id)
    {
        Portfolio::destroy($id);
        return response()->json(['message' => 'Portfólio deletado com sucesso!']);
    }
}

