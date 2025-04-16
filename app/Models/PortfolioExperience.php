<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id', 'role', 'company', 'period', 'description'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
