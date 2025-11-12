<?php

namespace App\Filament\Resources\BookingTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BookingTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("booking_trx_id")
                    ->searchable()
                    ->label('Booking ID'),
                ImageColumn::make("weddingPackage.thumbnail"),
                TextColumn::make("name")
                    ->searchable(),
                IconColumn::make("is_paid")
                    ->boolean()
                    ->trueColor("success")
                    ->falseColor("danger")
                    ->trueIcon("heroicon-o-check-circle")
                    ->falseIcon("heroicon-o-x-circle")
                    ->label("Verifikasi"),

            ])
            ->filters([
                // TrashedFilter::make(),
                // Filter based on the wedding package name
                SelectFilter::make("wedding_package_id")
                    ->label("Wedding Package")
                    ->relationship("weddingPackage", "name"),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
