<?php

namespace App\Filament\Resources;
use App\Filament\Resources\OrderResource\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'سفارش‌ها';

    protected static ?string $modelLabel = 'سفارش';

    protected static ?string $pluralModelLabel = 'سفارش‌ها';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سفارش')
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->label('شماره سفارش')
                            ->disabled(),

                        Forms\Components\Select::make('status')
                            ->label('وضعیت سفارش')
                            ->options([
                                'pending' => 'در انتظار',
                                'processing' => 'در حال پردازش',
                                'completed' => 'تکمیل شده',
                                'cancelled' => 'لغو شده',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('subtotal')
                            ->label('جمع جزء')
                            ->numeric()
                            ->disabled(),

                        Forms\Components\TextInput::make('total')
                            ->label('جمع کل')
                            ->numeric()
                            ->disabled(),

                        Forms\Components\TextInput::make('user.name')
                            ->label('کاربر')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('شماره سفارش')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('کاربر')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('وضعیت')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'completed' => 'تکمیل شده',
                        'cancelled' => 'لغو شده',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->label('مبلغ')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' تومان')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->dateTime('Y/m/d H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        'pending' => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'completed' => 'تکمیل شده',
                        'cancelled' => 'لغو شده',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                
            ]);
    }

   public static function getRelations(): array
{
    return [
        ItemsRelationManager::class,
    ];
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
