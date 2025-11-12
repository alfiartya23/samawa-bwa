<?php

namespace App\Filament\Resources\BookingTransactions\Schemas;

use App\Models\WeddingPackage;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;


class BookingTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Using Wizards Schema
                Wizard::make([
                    // ORDER
                    Step::make("Order Details")
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make("wedding_package_id")
                                        ->relationship("weddingPackage", "name")
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $weddingPackage = WeddingPackage::find($state);
                                            $price = $weddingPackage ? $weddingPackage->price : 0;

                                            $set("price", $price);

                                            $tax = 0.11;
                                            $totalTaxAmount = $tax * $price;

                                            $totalAmount = $price + $totalTaxAmount;
                                            $set("total_amount", number_format($totalAmount, 0, "", ""));
                                            $set("total_tax_amount", number_format($totalTaxAmount, 0, "", ""));
                                        }),

                                    TextInput::make("price")
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix("IDR"),

                                    // Readonly used to prevent admin to input the price amount
                                    // Its because it will automatically filled by the live()
                                    TextInput::make("total_tax_amount")
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix("IDR"),

                                    TextInput::make("total_amount")
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix("IDR"),

                                    DatePicker::make("started_at")
                                        ->required(),
                                ])

                        ]),

                    // CUSTOMER
                    Step::make("Customer Information")
                        ->schema([
                            Grid::make(2)
                                ->schema([

                                    TextInput::make("name")
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make("phone")
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make("email")
                                        ->required()
                                        ->maxLength(255),

                                ]),
                        ]),

                    // PAYMENT INFORMATION
                    Step::make("Payment Information")
                        ->schema([
                            TextInput::make("booking_trx_id")
                                ->required()
                                ->maxLength(255),

                            ToggleButtons::make("is_paid")
                                ->label("Apakah sudah membayar")
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => "heroicon-o-pencil",
                                    false => "heroicon-o-clock",
                                ])
                                ->required(),

                            FileUpload::make("proof")
                                ->required()
                                ->image(),

                        ])
                ])
                    ->columnSpanFull()
                    ->columns(1)
                    ->skippable(),
            ]);
    }
}
