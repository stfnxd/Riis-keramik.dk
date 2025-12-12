<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->square()
                    ->getStateUsing(function ($record) {
                        return $record->image_path ? asset('storage/' . $record->image_path) : null;
                    }),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('price')->money('dkk'),
                TextColumn::make('availability_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'in_stock' => 'In Stock',
                        'made_to_order' => 'Made to Order',
                        'sold_out' => 'Sold Out',
                        default => ucfirst($state),
                    })
                    ->color(fn ($state) => match ($state) {
                        'in_stock' => 'success',
                        'made_to_order' => 'warning',
                        'sold_out' => 'danger',
                        default => 'gray',
                    }),
                IconColumn::make('featured')->boolean()->label('⭐'),
                TextColumn::make('stock')->label('Stock'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
