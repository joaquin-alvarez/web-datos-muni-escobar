<?php

namespace App\Filament\Resources\DatasetResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FilesRelationManager extends RelationManager
{
    protected static string $relationship = 'formats';

    protected static ?string $title = 'Archivos del Dataset';

    protected static ?string $modelLabel = 'archivo';

    protected static ?string $pluralModelLabel = 'archivos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('format_id')
                    ->label('Formato')
                    ->relationship('', 'name')
                    ->required()
                    ->reactive()
                    ->options(function () {
                        return \App\Models\Format::pluck('name', 'id');
                    }),
                
                Forms\Components\FileUpload::make('file')
                    ->label('Archivo')
                    ->required()
                    ->disk('r2')
                    ->directory(function (RelationManager $livewire) {
                        $dataset = $livewire->getOwnerRecord();
                        return 'datasets/' . $dataset->slug;
                    })
                    ->visibility('public')
                    ->acceptedFileTypes([
                        'application/json',
                        'application/geo+json',
                        'application/vnd.google-earth.kml+xml',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'text/csv',
                        'application/x-dbf',
                        'application/x-shp',
                        'application/zip',
                    ])
                    ->maxSize(51200)
                    ->downloadable()
                    ->openable()
                    ->preserveFilenames()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state instanceof TemporaryUploadedFile) {
                            $set('file_name', $state->getClientOriginalName());
                            $set('file_size', $state->getSize());
                        }
                    }),

                Forms\Components\TextInput::make('file_name')
                    ->label('Nombre del archivo')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Hidden::make('file_size')
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Formato')
                    ->badge()
                    ->color(fn ($record) => 'primary'),
                
                Tables\Columns\TextColumn::make('pivot.file_name')
                    ->label('Nombre del archivo')
                    ->searchable()
                    ->limit(40),
                
                Tables\Columns\TextColumn::make('pivot.file_size')
                    ->label('Tamaño')
                    ->formatStateUsing(fn ($state) => $this->formatBytes($state ?? 0))
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('pivot.file_url')
                    ->label('URL')
                    ->limit(30)
                    ->copyable()
                    ->copyMessage('URL copiada')
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Subido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Subir archivo')
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire): array {
                        $dataset = $livewire->getOwnerRecord();
                        
                        if (isset($data['file']) && is_string($data['file'])) {
                            $r2Url = rtrim(config('filesystems.disks.r2.url', ''), '/');
                            $data['file_url'] = $r2Url ? $r2Url . '/' . $data['file'] : '/storage/' . $data['file'];
                        }
                        
                        unset($data['file']);
                        
                        return $data;
                    })
                    ->using(function (array $data, RelationManager $livewire): void {
                        $dataset = $livewire->getOwnerRecord();
                        
                        $dataset->formats()->attach($data['format_id'], [
                            'file_name' => $data['file_name'],
                            'file_url' => $data['file_url'],
                            'file_size' => $data['file_size'] ?? 0,
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => $record->pivot->file_url)
                    ->openUrlInNewTab(),
                
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->mutateFormDataUsing(function (array $data, $record, RelationManager $livewire): array {
                        $dataset = $livewire->getOwnerRecord();
                        
                        if (isset($data['file']) && is_string($data['file'])) {
                            if ($record->pivot->file_url) {
                                $oldPath = parse_url($record->pivot->file_url, PHP_URL_PATH);
                                $oldPath = ltrim($oldPath, '/');
                                if (str_starts_with($oldPath, 'datasets/')) {
                                    Storage::disk('r2')->delete($oldPath);
                                }
                            }
                            
                            $r2Url = rtrim(config('filesystems.disks.r2.url', ''), '/');
                            $data['file_url'] = $r2Url ? $r2Url . '/' . $data['file'] : '/storage/' . $data['file'];
                        }
                        
                        unset($data['file']);
                        
                        return $data;
                    })
                    ->using(function (array $data, $record): void {
                        $record->pivot->update([
                            'file_name' => $data['file_name'],
                            'file_url' => $data['file_url'] ?? $record->pivot->file_url,
                            'file_size' => $data['file_size'] ?? $record->pivot->file_size,
                        ]);
                    }),
                
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar')
                    ->before(function ($record) {
                        if ($record->pivot->file_url) {
                            $path = parse_url($record->pivot->file_url, PHP_URL_PATH);
                            $path = ltrim($path, '/');
                            
                            if (str_starts_with($path, 'datasets/')) {
                                Storage::disk('r2')->delete($path);
                            }
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->pivot->file_url) {
                                    $path = parse_url($record->pivot->file_url, PHP_URL_PATH);
                                    $path = ltrim($path, '/');
                                    
                                    if (str_starts_with($path, 'datasets/')) {
                                        Storage::disk('r2')->delete($path);
                                    }
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('pivot.created_at', 'desc');
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes === 0) return '0 B';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
