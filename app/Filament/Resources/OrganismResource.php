<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganismResource\Pages;
use App\Models\Organism;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrganismResource extends Resource
{
    protected static ?string $model = Organism::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Gobierno';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Organismo';

    protected static ?string $pluralModelLabel = 'Organismos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del organismo')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'Intendencia' => 'Intendencia',
                                'Secretaría' => 'Secretaría',
                                'Subsecretaría' => 'Subsecretaría',
                                'Dirección' => 'Dirección',
                                'Ente Descentralizado' => 'Ente Descentralizado',
                            ])
                            ->required(),
                        Forms\Components\Select::make('parent_id')
                            ->label('Organismo padre')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(3),
                        Forms\Components\Textarea::make('functions')
                            ->label('Funciones (separadas por punto)')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Responsable')
                    ->schema([
                        Forms\Components\TextInput::make('head_name')
                            ->label('Nombre del responsable')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('head_position')
                            ->label('Cargo del responsable')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Intendencia' => 'danger',
                        'Secretaría' => 'primary',
                        'Subsecretaría' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Depende de')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('head_name')
                    ->label('Responsable')
                    ->searchable(),
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
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganisms::route('/'),
            'create' => Pages\CreateOrganism::route('/create'),
            'edit' => Pages\EditOrganism::route('/{record}/edit'),
        ];
    }
}
