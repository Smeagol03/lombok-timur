<?php

namespace App\Filament\Resources\LinkBanners;

use App\Filament\Resources\LinkBanners\Pages\CreateLinkBanner;
use App\Filament\Resources\LinkBanners\Pages\EditLinkBanner;
use App\Filament\Resources\LinkBanners\Pages\ListLinkBanners;
use App\Filament\Resources\LinkBanners\Schemas\LinkBannerForm;
use App\Filament\Resources\LinkBanners\Tables\LinkBannersTable;
use App\Models\LinkBanner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LinkBannerResource extends Resource
{
    protected static ?string $model = LinkBanner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LinkBannerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LinkBannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLinkBanners::route('/'),
            'create' => CreateLinkBanner::route('/create'),
            'edit' => EditLinkBanner::route('/{record}/edit'),
        ];
    }
}
