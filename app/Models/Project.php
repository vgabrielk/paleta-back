<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use BelongsToTenant;
    //
    protected $fillable = ['portfolio_id', 'nome', 'descricao', 'link', 'tenant_id'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
