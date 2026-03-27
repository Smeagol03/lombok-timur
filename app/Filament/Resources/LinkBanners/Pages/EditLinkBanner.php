<?php

namespace App\Filament\Resources\LinkBanners\Pages;

use App\Filament\Resources\LinkBanners\LinkBannerResource;
use App\Models\LinkBanner;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/**
 * @extends EditRecord<LinkBanner>
 */
class EditLinkBanner extends EditRecord
{
    protected static string $resource = LinkBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
