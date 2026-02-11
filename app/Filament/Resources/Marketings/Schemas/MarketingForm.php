<?php

namespace App\Filament\Resources\Marketings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class MarketingForm
{
    public static function configure(Schema $schema): Schema
    { 
        return $schema
            ->components([
                TextInput::make('top_raise')
                ->label('أعلى نمو محقق')
                ->numeric()
                ->required(),
                TextInput::make('access')
                ->label('وصول اجمالى')
                ->numeric() 
                ->required(),
                TextInput::make('range_raise')
                ->label('متوسط نسبة النمو') 
                ->numeric()
                ->required(),
                TextInput::make('total_watching')
                ->label('اجمالى المشاهدات') 
                ->numeric()
                ->required(),
                TextInput::make('youtube_watsh')
                ->label('مشاهدات اليوتيوب') 
                ->numeric()
                ->required(),
                FileUpload::make('youtube_image')
                ->label('صورة ارباح اليوتيوب') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع صورة ارباح اليوتيوب'), 
                TextInput::make('youtube_profits')
                ->label('أرباح اليوتيوب') 
                ->numeric()
                ->required(),
                TextInput::make('youtube_period')
                ->label('الفترة يوتيوب') 
                ->required(), 
                FileUpload::make('face_image')
                ->label('صورة ارباح الفيس بوك') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع صورة ارباح الفيس بوك'), 
                TextInput::make('face_access')
                ->label('وصول الفيس بوك') 
                ->numeric()
                ->required(),
                TextInput::make('face_comments')
                ->label('تعليقات الفيس بوك') 
                ->numeric()
                ->required(),
                TextInput::make('face_access')
                ->label('وصول الفيس بوك') 
                ->numeric()
                ->required(),
                TextInput::make('face_save')
                ->label('الحفظ فيس بوك') 
                ->numeric()
                ->required(),
                TextInput::make('face_share')
                ->label('مشاركات الفيس بوك') 
                ->numeric()
                ->required(),
                FileUpload::make('overall_growth_image')
                ->label('صورة نمو متكامل') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع صورة نمو متكامل'),
                TextInput::make('overall_growth_calling')
                ->label('اتصال نمو متكامل')
                ->numeric()
                ->required(),
                TextInput::make('overall_growth_response')
                ->label('استجابة نمو متكامل')
                ->numeric()
                ->required(),
                TextInput::make('overall_growth_chats')
                ->label('محادثات نمو متكامل')
                ->numeric()
                ->required(),
                TextInput::make('overall_growth_watches')
                ->label('مشاهدات نمو متكامل')
                ->numeric()
                ->required(),
                TextInput::make('overall_growth_reaction')
                ->label('التفاعلات نمو متكامل')
                ->numeric()
                ->required(),
                FileUpload::make('analysis_image')
                ->label('صورة تحليلات') 
                ->image()
                ->required()
                ->disk('public')
                ->directory('images')
                ->placeholder('رفع صورة التحليلات'),
                TextInput::make('analysis_growth')
                ->label('النمو تحليلات') 
                ->numeric()
                ->required(),
                TextInput::make('analysis_watches')
                ->label('مشاهدات تحليلات') 
                ->numeric()
                ->required(), 
            ]);
    }
}
