<?php

namespace App\Filament\Resources\ProdukResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class UlasanRelationManager extends RelationManager
{
    protected static string $relationship = 'ulasan';
    protected static ?string $title = 'Ulasan Pelanggan';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('reviewer_name')
                ->label('Nama Reviewer')
                ->required(),

            Forms\Components\Select::make('rating')
                ->label('Rating')
                ->options([
                    1 => '⭐ 1',
                    2 => '⭐⭐ 2',
                    3 => '⭐⭐⭐ 3',
                    4 => '⭐⭐⭐⭐ 4',
                    5 => '⭐⭐⭐⭐⭐ 5',
                ])
                ->required(),

            Forms\Components\TextInput::make('title')
                ->label('Judul Review')
                ->columnSpanFull(),

            Forms\Components\Textarea::make('body')
                ->label('Isi Review')
                ->rows(3)
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_verified')
                ->label('Verified Purchase'),

            Forms\Components\Toggle::make('is_visible')
                ->label('Tampilkan')
                ->default(true),

        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('reviewer_name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state)),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(40),

                Tables\Columns\TextColumn::make('body')
                    ->label('Review')
                    ->limit(60)
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean(),

                // bisa toggle langsung dari tabel tanpa buka form
                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Tampil'),

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
