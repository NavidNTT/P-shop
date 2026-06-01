<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'آیتم‌های سفارش';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->disabled(),

                Forms\Components\TextInput::make('price')
                    ->disabled(),

                Forms\Components\TextInput::make('quantity')
                    ->disabled(),

                Forms\Components\TextInput::make('line_total')
                    ->disabled(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_id')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('محصول'),

                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت واحد')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' تومان'),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('تعداد'),

                Tables\Columns\TextColumn::make('line_total')
                    ->label('جمع')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' تومان'),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
