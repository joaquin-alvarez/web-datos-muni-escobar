<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatasetResource\Pages;
use App\Models\Dataset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DatasetResource extends Resource
{
    protected static ?string $model = Dataset::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationGroup = 'Datos Abiertos';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información principal')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(4),
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('organization')
                            ->label('Organización')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Metadatos')
                    ->schema([
                        Forms\Components\TextInput::make('version')
                            ->label('Versión')
                            ->default('1.0')
                            ->maxLength(20),
                        Forms\Components\Select::make('periodicity')
                            ->label('Periodicidad')
                            ->options([
                                'Diaria' => 'Diaria',
                                'Semanal' => 'Semanal',
                                'Mensual' => 'Mensual',
                                'Trimestral' => 'Trimestral',
                                'Semestral' => 'Semestral',
                                'Anual' => 'Anual',
                            ])
                            ->default('Mensual'),
                        Forms\Components\TextInput::make('source')
                            ->label('Fuente')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('license')
                            ->label('Licencia')
                            ->default('Open Data Commons Open Database License (ODbL)')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('created_date')
                            ->label('Fecha de creación'),
                        Forms\Components\DateTimePicker::make('last_modified')
                            ->label('Última modificación'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('organization')
                    ->label('Organización')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('version')
                    ->label('Versión')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('periodicity')
                    ->label('Periodicidad')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('last_modified')
                    ->label('Última modificación')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('last_modified', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDatasets::route('/'),
            'create' => Pages\CreateDataset::route('/create'),
            'edit' => Pages\EditDataset::route('/{record}/edit'),
        ];
    }
}
