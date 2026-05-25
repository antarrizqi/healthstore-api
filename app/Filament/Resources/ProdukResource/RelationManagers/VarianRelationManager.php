<?php

namespace App\Filament\Resources\ProdukResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VarianRelationManager extends RelationManager
{
    // nama relasi yang didefinisikan di Model Produk
    protected static string $relationship = 'varian';
    protected static ?string $title = 'Varian Produk';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('flavor')
                ->label('Rasa')
                ->placeholder('Chocolate, Vanilla...')
                ->maxLength(100),

            Forms\Components\TextInput::make('weight')
                ->label('Ukuran')
                ->placeholder('1kg, 500g...')
                ->maxLength(50),

            Forms\Components\TextInput::make('sku')
                ->label('SKU')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Forms\Components\TextInput::make('stock')
                ->label('Stok')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_available')
                ->label('Tersedia')
                ->default(true),

        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('flavor')
                    ->label('Rasa'),

                Tables\Columns\TextColumn::make('weight')
                    ->label('Ukuran'),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 5  => 'warning',
                        default      => 'success',
                    }),

                Tables\Columns\IconColumn::make('is_available')
                    ->label('Tersedia')
                    ->boolean(),

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
