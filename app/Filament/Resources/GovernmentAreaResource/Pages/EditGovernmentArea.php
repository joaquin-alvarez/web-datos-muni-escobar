<?php

namespace App\Filament\Resources\GovernmentAreaResource\Pages;

use App\Filament\Resources\GovernmentAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGovernmentArea extends EditRecord
{
    protected static string $resource = GovernmentAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
