<?php

namespace App\Models;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use App\Models\Template;
use App\Models\User;

class Portfolio extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'template_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function getNameAttribute()
    {
        return $this->data['name'] ?? null;
    }

    public function getTitleAttribute()
    {
        return $this->data['title'] ?? null;
    }

    public function getDescriptionAttribute()
    {
        return $this->data['description'] ?? null;
    }

    public function getAvatarAttribute()
    {
        return $this->data['avatar'] ?? null;
    }

    public function getLinksAttribute()
    {
        return $this->data['links'] ?? [];
    }

    public function getExperiencesAttribute()
    {
        return $this->data['experiences'] ?? [];
    }

    public function getEducationAttribute()
    {
        return $this->data['education'] ?? [];
    }

    public function getProjectsAttribute()
    {
        return $this->data['projects'] ?? [];
    }
}
