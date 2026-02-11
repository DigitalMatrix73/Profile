<?php

namespace App\Filament\Resources\Visions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class VisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('years')
                ->label("اسنوات الخبرة")
                ->required()
                ->numeric(),
                TextInput::make('clients')
                ->label("العملاء")
                ->required()
                ->numeric(),
                TextInput::make('projects')
                ->label("المشاريع")
                ->required()
                ->numeric(), 
                Textarea::make('msg')
                ->label("الرسالة")
                ->placeholder("الرسالة")
                ->required(), 
                Textarea::make('vision')
                ->label("الرؤية")
                ->placeholder("الرؤية")
                ->required(), 
                Textarea::make('benifits')
                ->label("القيم")
                ->placeholder("القيم")
                ->required(), 
            ]);
    }
}
