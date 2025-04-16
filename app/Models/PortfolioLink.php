<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id', 'label', 'url'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
