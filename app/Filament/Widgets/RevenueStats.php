<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class RevenueStats extends StatsOverviewWidget
{
     protected static ?int $sort = 2;
    protected function getStats(): array
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        $todayRevenue = Order::query()
            ->where('status', 'completed')
            ->whereDate('created_at', $today)
            ->sum('total');

        $monthRevenue = Order::query()
            ->where('status', 'completed')
            ->where('created_at', '>=', $monthStart)
            ->sum('total');

        $allTimeRevenue = Order::query()
            ->where('status', 'completed')
            ->sum('total');

        $fmt = fn ($amount) => number_format((int) $amount) . ' تومان';

        return [
            Stat::make('فروش امروز', $fmt($todayRevenue))
                ->color('info')
                ->icon('heroicon-o-banknotes'),

            Stat::make('فروش این ماه', $fmt($monthRevenue))
                ->color('primary')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('فروش کل', $fmt($allTimeRevenue))
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
}
