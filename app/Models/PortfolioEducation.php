<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id', 'course', 'institution', 'period'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
