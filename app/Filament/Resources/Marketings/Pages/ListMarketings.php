<?php

namespace App\Filament\Resources\Marketings\Pages;

use App\Filament\Resources\Marketings\MarketingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarketings extends ListRecords
{
    protected static string $resource = MarketingResource::class;

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
