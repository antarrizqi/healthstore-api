<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UlasanResource\Pages;
use App\Models\Ulasan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UlasanResource extends Resource
{
    protected static ?string $model = Ulasan::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Ulasan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Info Ulasan')
                ->schema([

                    Forms\Components\Select::make('produk_id')
                        ->label('Produk')
                        ->relationship('produk', 'name')
                        ->searchable()
                        ->preload()
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

                    Forms\Components\TextInput::make('reviewer_name')
                        ->label('Nama Reviewer')
                        ->required(),

                    Forms\Components\TextInput::make('reviewer_avatar')
                        ->label('URL Avatar')
                        ->nullable(),

                    Forms\Components\TextInput::make('title')
                        ->label('Judul Review')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('body')
                        ->label('Isi Review')
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_verified')
                        ->label('Verified Purchase'),

                    Forms\Components\Toggle::make('is_visible')
                        ->label('Tampilkan')
                        ->default(true),

                ])->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('produk.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('reviewer_name')
                    ->label('Reviewer')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state))
                    ->sortable(),

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

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Tampil'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('produk')
                    ->relationship('produk', 'name')
                    ->label('Produk'),

                Tables\Filters\SelectFilter::make('rating')
                    ->options([
                        1 => '⭐ 1',
                        2 => '⭐⭐ 2',
                        3 => '⭐⭐⭐ 3',
                        4 => '⭐⭐⭐⭐ 4',
                        5 => '⭐⭐⭐⭐⭐ 5',
                    ])
                    ->label('Rating'),

                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Ditampilkan'),

                Tables\Filters\TernaryFilter::make('is_verified')
                    ->label('Verified'),

            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUlasans::route('/'),
            'edit'  => Pages\EditUlasan::route('/{record}/edit'),
        ];
    }
}
