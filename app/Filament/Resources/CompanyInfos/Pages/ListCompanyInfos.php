<?php

namespace App\Filament\Resources\CompanyInfos\Pages;

use App\Filament\Resources\CompanyInfos\CompanyInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanyInfos extends ListRecords
{
    protected static string $resource = CompanyInfoResource::class;

    protected function getHeaderActions(): array
    {
        if(static::getModel()::count() < 1){

            return [
                CreateAction::make(),
            ];
        }
        return [];
    }
}
