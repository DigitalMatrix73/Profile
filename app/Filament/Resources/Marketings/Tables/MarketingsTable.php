<?php

namespace App\Filament\Resources\Marketings\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class MarketingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('top_raise')
                ->label("أعلى نمو"),
                TextColumn::make('range_raise')
                ->label("متوسط نسبة النمو"),
                TextColumn::make('access')
                ->label("وصول اجمالى"),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
