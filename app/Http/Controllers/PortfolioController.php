<?php
namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Http\Services\PortfolioService;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    protected PortfolioService $portfolioService;
    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }
    public function index()
    {
        return $this->portfolioService->getAll();
    }

    public function store(PortfolioRequest $request)
    {
      $this->portfolioService->add($request);
    }


    public function show($id)
    {
       return $this->portfolioService->get($id);
    }

    public function showByUrl($url)
    {
        return $this->portfolioService->getByUrl($url);
    }
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
      return $this->portfolioService->update($request, $portfolio);
    }
    public function destroy($id)
    {
      return $this->portfolioService->delete($id);
    }
}

