<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction; 
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup; 
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label("اسم المشروع"),
                TextColumn::make('description')
                ->label("وصف المشروع"),
                TextColumn::make('technics')
                ->label("التقنيات المستخدمة"),
                TextColumn::make('type')
                ->label("النوع"),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
