<?php

namespace App\Filament\Resources\Products\Schemas;


use Filament\Schemas\Schema;
use Filament\Forms\Components;
use Filament\Schemas\Components\Fieldset;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->required(),

                Components\FileUpload::make('image_path')
                    ->label('Product Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('products')
                    ->reorderable()
                    ->maxSize(8192)
                    ->imageEditor()
                    ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file->getPathname());
                        $image->scaleDown(width: 1600);
                        $encoded = $image->toWebp(80);
                        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $path = 'products/' . $filename . '-' . uniqid() . '.webp';
                        Storage::disk('public')->put($path, $encoded);
                        return $path;
                    }),


                Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('Dkk')
                    ->required(),

                Components\Textarea::make('description')
                    ->rows(3)
                    ->placeholder('Describe your ceramic product...'),

                Fieldset::make('Størrelse (cm)')
                    ->schema([
                        Components\TextInput::make('width')->numeric()->suffix('cm'),
                        Components\TextInput::make('height')->numeric()->suffix('cm'),
                    ])->columns(2),

                Fieldset::make('Detaljer')
                    ->schema([
                        Components\TextInput::make('weight')->numeric()->suffix('kg'),
                        Components\TextInput::make('stock')->numeric()->default(0),
                        Components\Select::make('availability_status')
                            ->label('Availability')
                            ->options([
                                'in_stock' => 'In Stock',
                                'made_to_order' => 'Made to Order',
                                'sold_out' => 'Sold Out',
                            ])
                            ->default('in_stock')
                            ->required(),
                        Components\Toggle::make('featured')->label('Featured Product'),
                    ])->columns(2),
                Components\Toggle::make('gallery')
                    ->label('Tilføj til Galleri')
                    ->default(false),
            ]);
    }
}
