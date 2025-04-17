<?php

namespace App\Http\Services ;
use App\Enums\SiteStatus;
use App\Models\Portfolio;
use Illuminate\Validation\Rule;

class PublishPortfolioService
{
    public static function publishPortfolio($request, $portfolio)
    {
        $validated = $request->validate([
            'data'              => 'required|array',
            'data.site_url'     => 'nullable|string|max:25',
            'data.site_status'  => ['nullable', 'string', Rule::in(SiteStatus::values())],
        ]);

        $data    = $validated['data'];

        if (array_key_exists('site_url', $data)) {
            $siteUrl = $data['site_url'];

            if (! empty($siteUrl)) {
                $exists = Portfolio::where('data->site_url', $siteUrl)
                    ->where('id', '!=', $portfolio->id)
                    ->exists();

                if ($exists) {
                    return response()->json([
                        'message' => 'Essa URL já está sendo usada por outro usuário!',
                        'errors'  => [
                            'site_url' => ['Essa URL já está sendo usada por outro usuário!']
                        ]
                    ], 422);
                }
            }

            $portfolio->setDataValue('site_url', $siteUrl);
        }

        $portfolio->setDataValue('site_status', SiteStatus::PUBLICADO->value);

        $portfolio->save();

        return response()->json($portfolio);
    }

    public static function unpublishPortfolio($request, $portfolio)
    {
        $validated = $request->validate([
            'data.site_url' => 'nullable|string|max:25',
            'data.site_status' => ['nullable', 'string', Rule::in(SiteStatus::values())],
        ]);

        $portfolio->setDataValue('site_url', null);
        $portfolio->setDataValue('site_status', SiteStatus::RASCUNHO->value);
        $portfolio->save();
        return response()->json($portfolio);
    }

}
