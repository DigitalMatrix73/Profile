<?php

namespace App\Filament\Resources\CompanyInfos;

use App\Filament\Resources\CompanyInfos\Pages\CreateCompanyInfo;
use App\Filament\Resources\CompanyInfos\Pages\EditCompanyInfo;
use App\Filament\Resources\CompanyInfos\Pages\ListCompanyInfos;
use App\Filament\Resources\CompanyInfos\Schemas\CompanyInfoForm;
use App\Filament\Resources\CompanyInfos\Tables\CompanyInfosTable;
use App\Models\CompanyInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyInfoResource extends Resource
{
    protected static ?string $model = CompanyInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'CompanyInfo';

    public static function form(Schema $schema): Schema
    {
        return CompanyInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyInfosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return static::getModel()::count() < 1;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanyInfos::route('/'),
            'create' => CreateCompanyInfo::route('/create'),
            'edit' => EditCompanyInfo::route('/{record}/edit'),
        ];
    }
}
