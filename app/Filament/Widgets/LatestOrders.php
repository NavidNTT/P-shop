<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'سفارش‌های اخیر';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->with('user')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('شماره')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('کاربر')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('وضعیت')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'completed' => 'تکمیل شده',
                        'cancelled' => 'لغو شده',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->label('مبلغ')
                    ->formatStateUsing(fn ($state) => number_format((int) $state) . ' تومان'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ')
                    ->dateTime('Y/m/d H:i'),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label('مشاهده')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Order $record) => \App\Filament\Resources\OrderResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
