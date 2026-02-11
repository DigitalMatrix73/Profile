<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label("اسم المشروع"),
                TextInput::make('description')
                ->label("وصف المشروع"),
                TextInput::make('technics')
                ->label("التقنيات المستخدمة"),
                Select::make('type')
                ->label('النوع')
                ->required()
                ->options([
                    'web' => 'ويب',
                    'mobile' => 'موبيل ابليكشن',
                    'graphic' => 'جرافيك',
                    'marketing' => 'التسويق الاليكترونى',
                ])
                ->placeholder('اختر النوع'),
                FileUpload::make('image')
                ->label('صورة المشروع') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع صورة المشروع'), 
            ]);
    }
}
