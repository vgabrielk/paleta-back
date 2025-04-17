<?php

namespace App\Http\Services;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\Template;

class PortfolioService
{
    public static function getAll()
    {
        $portfolios = Portfolio::all();
        return response()->json($portfolios);
    }
    public static function get($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return response()->json($portfolio);
    }

    public function add($request)
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

    public static function update($request, $portfolio)
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

    public function getByUrl($url)
    {
        $portfolio = Portfolio::whereJsonContains('data', ['site_url' => $url])
            ->firstOrFail();
        return response()->json($portfolio);
    }

    public static function delete($id)
    {
        Portfolio::destroy($id);
        return response()->json(['message' => 'Portfólio deletado com sucesso!']);
    }
}
