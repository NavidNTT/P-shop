<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersStats extends StatsOverviewWidget
{
     protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $totalOrders = Order::query()->count();
        $pending = Order::query()->where('status', 'pending')->count();
        $completed = Order::query()->where('status', 'completed')->count();

        return [
            Stat::make('کل سفارش‌ها', $totalOrders)
                ->icon('heroicon-o-shopping-bag'),

            Stat::make('در انتظار', $pending)
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('تکمیل شده', $completed)
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
