<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GlossaryTermResource\Pages;
use App\Models\GlossaryTerm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GlossaryTermResource extends Resource
{
    protected static ?string $model = GlossaryTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Portal';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Término del Glosario';

    protected static ?string $pluralModelLabel = 'Glosario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('term')
                    ->label('Término')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                        $set('letter', mb_strtoupper(mb_substr($state ?? '', 0, 1)));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('letter')
                    ->label('Letra')
                    ->maxLength(1)
                    ->required(),
                Forms\Components\Textarea::make('definition')
                    ->label('Definición')
                    ->required()
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('letter')
                    ->label('Letra')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('term')
                    ->label('Término')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('definition')
                    ->label('Definición')
                    ->limit(60)
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('letter')
                    ->label('Letra')
                    ->options(fn () => GlossaryTerm::selectRaw('DISTINCT letter')
                        ->orderBy('letter')
                        ->pluck('letter', 'letter')
                        ->toArray()),
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
            ->defaultSort('term');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGlossaryTerms::route('/'),
            'create' => Pages\CreateGlossaryTerm::route('/create'),
            'edit' => Pages\EditGlossaryTerm::route('/{record}/edit'),
        ];
    }
}
