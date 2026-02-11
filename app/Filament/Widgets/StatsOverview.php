<?php

namespace App\Filament\Widgets;

use App\Models\Dataset;
use App\Models\Category;
use App\Models\Official;
use App\Models\GlossaryTerm;
use App\Models\InformationRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Datasets', Dataset::count())
                ->description('Total de datasets publicados')
                ->descriptionIcon('heroicon-m-circle-stack')
                ->color('primary'),
            Stat::make('Categorías', Category::count())
                ->description('Categorías disponibles')
                ->descriptionIcon('heroicon-m-tag')
                ->color('success'),
            Stat::make('Funcionarios', Official::count())
                ->description('Registrados en el sistema')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),
            Stat::make('Términos del Glosario', GlossaryTerm::count())
                ->description('Definiciones publicadas')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('info'),
            Stat::make('Solicitudes pendientes', InformationRequest::where('status', 'pending')->count())
                ->description('Requieren atención')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger'),
        ];
    }
}
