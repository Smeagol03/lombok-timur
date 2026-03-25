<?php

namespace App\Filament\Resources\LinkBanners\Pages;

use App\Filament\Resources\LinkBanners\LinkBannerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLinkBanners extends ListRecords
{
    protected static string $resource = LinkBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
