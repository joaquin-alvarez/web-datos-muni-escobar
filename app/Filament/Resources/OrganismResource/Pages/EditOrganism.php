<?php

namespace App\Filament\Resources\OrganismResource\Pages;

use App\Filament\Resources\OrganismResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganism extends EditRecord
{
    protected static string $resource = OrganismResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
