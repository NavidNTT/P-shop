<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'آیتم‌های سفارش';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('محصول')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت واحد')
                    ->formatStateUsing(fn ($state) => number_format((int) $state) . ' تومان'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('تعداد'),

                Tables\Columns\TextColumn::make('line_total')
                    ->label('جمع')
                    ->formatStateUsing(fn ($state) => number_format((int) $state) . ' تومان'),
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
