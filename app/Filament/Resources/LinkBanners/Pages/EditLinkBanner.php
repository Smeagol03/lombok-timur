<?php

namespace App\Filament\Resources\LinkBanners\Pages;

use App\Filament\Resources\LinkBanners\LinkBannerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

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
