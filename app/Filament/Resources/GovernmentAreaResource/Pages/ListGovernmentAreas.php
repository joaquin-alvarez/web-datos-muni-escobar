<?php

namespace App\Filament\Resources\GovernmentAreaResource\Pages;

use App\Filament\Resources\GovernmentAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovernmentAreas extends ListRecords
{
    protected static string $resource = GovernmentAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
