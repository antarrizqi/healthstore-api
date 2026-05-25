<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([

            // KOLOM KIRI - konten utama
            Forms\Components\Group::make()
                ->schema([

                    Forms\Components\Section::make('Info Produk')
                        ->schema([

                            Forms\Components\TextInput::make('name')
                                ->label('Nama Produk')
                                ->required()
                                ->maxLength(200)
                                ->live(onBlur: true)
                                ->afterStateUpdated(
                                    fn(?string $state, Forms\Set $set) =>
                                    $set('slug', Str::slug($state ?? ''))
                                ),

                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\TextInput::make('brand')
                                ->label('Brand')
                                ->maxLength(100),

                            Forms\Components\Textarea::make('short_description')
                                ->label('Deskripsi Singkat')
                                ->rows(2)
                                ->maxLength(300)
                                ->columnSpanFull(),

                            Forms\Components\RichEditor::make('description')
                                ->label('Deskripsi Lengkap')
                                ->columnSpanFull()
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'bulletList',
                                    'orderedList',
                                    'h2',
                                    'h3',
                                    'undo',
                                    'redo',
                                ]),

                        ])->columns(2),

                    Forms\Components\Section::make('Gambar Produk')
                        ->schema([

                            Forms\Components\FileUpload::make('main_image')
                                ->label('Foto Utama')
                                ->image()
                                ->directory('produk/utama')
                                ->imageEditor()
                                ->columnSpanFull(),

                            Forms\Components\Repeater::make('gambarProduk')
                                ->label('Galeri Foto')
                                ->relationship()
                                ->schema([

                                    Forms\Components\FileUpload::make('image_path')
                                        ->label('Foto')
                                        ->image()
                                        ->directory('produk/galeri')
                                        ->required(),

                                    Forms\Components\TextInput::make('sort_order')
                                        ->label('Urutan')
                                        ->numeric()
                                        ->default(0),

                                ])
                                ->columns(2)
                                ->addActionLabel('+ Tambah Foto')
                                ->columnSpanFull(),

                        ]),

                    Forms\Components\Section::make('Varian Produk')
                        ->schema([

                            Forms\Components\Repeater::make('varian')
                                ->label('Daftar Varian')
                                ->relationship()
                                ->schema([

                                    Forms\Components\TextInput::make('flavor')
                                        ->label('Rasa')
                                        ->placeholder('Chocolate, Vanilla...'),

                                    Forms\Components\TextInput::make('weight')
                                        ->label('Ukuran')
                                        ->placeholder('1kg, 500g...'),

                                    Forms\Components\TextInput::make('sku')
                                        ->label('SKU')
                                        ->required(),

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

                                ])
                                ->columns(3)
                                ->addActionLabel('+ Tambah Varian')
                                ->columnSpanFull(),

                        ]),

                    Forms\Components\Section::make('Info Nutrisi')
                        ->schema([

                            Forms\Components\TextInput::make('serving_size')
                                ->label('Serving Size')
                                ->placeholder('33g'),

                            Forms\Components\TextInput::make('servings_per_container')
                                ->label('Servings per Container')
                                ->placeholder('30 servings'),

                            Forms\Components\Repeater::make('nutrition_facts')
                                ->label('Tabel Nutrisi')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->label('Nutrisi')
                                        ->required(),
                                    Forms\Components\TextInput::make('amount')
                                        ->label('Jumlah')
                                        ->required(),
                                ])
                                ->columns(2)
                                ->addActionLabel('+ Tambah Nutrisi')
                                ->columnSpanFull(),

                            Forms\Components\Repeater::make('benefits')
                                ->label('Keunggulan Produk')
                                ->simple(
                                    Forms\Components\TextInput::make('benefit')
                                        ->placeholder('25g protein per serving')
                                )
                                ->addActionLabel('+ Tambah Benefit')
                                ->columnSpanFull(),

                        ])->columns(2),

                ])->columnSpan(2),

            // KOLOM KANAN - sidebar
            Forms\Components\Group::make()
                ->schema([

                    Forms\Components\Section::make('Status & Pengaturan')
                        ->schema([

                            Forms\Components\Select::make('kategori_id')
                                ->label('Kategori')
                                ->relationship('kategori', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('status')
                                ->label('Status Produk')
                                ->options([
                                    'active'       => 'Aktif',
                                    'inactive'     => 'Nonaktif',
                                    'out_of_stock' => 'Stok Habis',
                                ])
                                ->default('active')
                                ->required(),

                            Forms\Components\Toggle::make('is_featured')
                                ->label('Produk Unggulan'),

                            Forms\Components\TextInput::make('base_price')
                                ->label('Harga Dasar')
                                ->numeric()
                                ->prefix('Rp')
                                ->required(),

                            Forms\Components\TextInput::make('stock')
                                ->label('Total Stok')
                                ->numeric()
                                ->default(0),

                        ]),

                ])->columnSpan(1),

        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('main_image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Produk $record): string => $record->brand ?? ''),

                Tables\Columns\TextColumn::make('kategori.name')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('base_price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 10 => 'warning',
                        default      => 'success',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active'       => 'success',
                        'inactive'     => 'warning',
                        'out_of_stock' => 'danger',
                        default        => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('kategori')
                    ->relationship('kategori', 'name')
                    ->label('Kategori'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active'       => 'Aktif',
                        'inactive'     => 'Nonaktif',
                        'out_of_stock' => 'Stok Habis',
                    ]),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Produk Unggulan'),

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
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\VarianRelationManager::class,
            RelationManagers\UlasanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit'   => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
