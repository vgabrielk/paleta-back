<?php

namespace App\Http\Controllers;

use App\Http\Services\PublishPortfolioService;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PublishPortfolioController extends Controller
{
    protected PublishPortfolioService $publishPortfolioService;

    public function __construct(PublishPortfolioService $publishPortfolioService)
    {
        $this->publishPortfolioService = $publishPortfolioService;
    }

    public function publish(Request $request, Portfolio $portfolio)
    {
      return $this->publishPortfolioService->publishPortfolio($request, $portfolio);
    }

    public function unpublish(Request $request, Portfolio $portfolio)
    {
        return $this->publishPortfolioService->unpublishPortfolio($request, $portfolio);

    }
}
