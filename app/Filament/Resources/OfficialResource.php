<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficialResource\Pages;
use App\Models\Official;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OfficialResource extends Resource
{
    protected static ?string $model = Official::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gobierno';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Funcionario';

    protected static ?string $pluralModelLabel = 'Funcionarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos personales')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('position')
                            ->label('Cargo')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('rank')
                            ->label('Categoría')
                            ->options([
                                'Intendente' => 'Intendente',
                                'Secretario/a' => 'Secretario/a',
                                'Subsecretario/a' => 'Subsecretario/a',
                                'Director/a' => 'Director/a',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('area')
                            ->label('Área')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('biography')
                            ->label('Biografía')
                            ->rows(4),
                    ])->columns(2),

                Forms\Components\Section::make('Contacto y archivos')
                    ->schema([
                        Forms\Components\TextInput::make('photo_url')
                            ->label('URL de foto')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cv_url')
                            ->label('URL del CV')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->maxLength(50),
                        Forms\Components\Toggle::make('is_intendente')
                            ->label('Es Intendente'),
                        Forms\Components\Toggle::make('is_cabinet')
                            ->label('Es parte del Gabinete'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_url')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Cargo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rank')
                    ->label('Categoría')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('area')
                    ->label('Área')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_intendente')
                    ->label('Intendente')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_cabinet')
                    ->label('Gabinete')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_cabinet')
                    ->label('Gabinete'),
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
            'index' => Pages\ListOfficials::route('/'),
            'create' => Pages\CreateOfficial::route('/create'),
            'edit' => Pages\EditOfficial::route('/{record}/edit'),
        ];
    }
}
