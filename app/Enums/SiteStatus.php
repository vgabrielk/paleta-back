<?php

namespace App\Enums;

enum SiteStatus: string
{
    case RASCUNHO = 'draft';
    case PUBLICADO = 'published';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    public function getSiteStatusAttribute(): ?SiteStatus
    {
        return SiteStatus::tryFrom($this->data['site_status'] ?? null);
    }
}
