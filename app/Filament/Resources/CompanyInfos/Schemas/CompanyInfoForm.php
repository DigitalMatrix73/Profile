<?php

namespace App\Filament\Resources\CompanyInfos\Schemas;

use Filament\Schemas\Schema;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;

class CompanyInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ 
                TextInput::make('address')
                ->label('Address') 
                ->required(),
                TextInput::make('email')
                ->label('E-mail') 
                ->email()
                ->required(),
                TextInput::make('phone')
                ->label('Phone') 
                ->required(),
                TextInput::make('phone2') 
                ->label('Second Phone'),
                TextInput::make('facebook')
                ->label('Facebook'),
                TextInput::make('tweeter')
                ->label('Tweeter'),
                TextInput::make('linked_in')
                ->label('Linked In'),
                TextInput::make('instagram')
                ->label('Instagram'),
                TextInput::make('tiktok')
                ->label('Tiktok'),
                Map::make('location')
                ->label('اختر الموقع على الخريطة')
                ->columnSpanFull()
                ->afterStateUpdated(function (Set $set, ?array $state): void {
                    $set('lat', $state['lat']);
                    $set('lng', $state['lng']);
                })
                ->live()
                ->required()
                ->defaultLocation(latitude: 30.0444, longitude: 31.2357),
                TextInput::make('lat')  
                ->numeric()
                ->default(30.0444)
                ->required() 
                ->dehydrated(),

                TextInput::make('lng') 
                ->numeric()
                ->default(31.2357) 
                ->required() 
                ->dehydrated(),
 
            ]);
    }
}
