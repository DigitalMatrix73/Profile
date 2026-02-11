<?php

namespace App\Filament\Resources\Teams\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label('الأسم')
                ->required(),
                TextInput::make('position')
                ->label('الوظيفة')
                ->required(),
                FileUpload::make('image')
                ->label('الصورة الشخصية') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع الصورة الشخصية'),
            ]);
    }
}
