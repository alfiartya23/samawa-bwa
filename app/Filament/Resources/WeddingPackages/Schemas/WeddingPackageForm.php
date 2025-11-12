<?php

namespace App\Filament\Resources\WeddingPackages\Schemas;

use App\Models\BonusPackage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class WeddingPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // DETAILS
                Fieldset::make("Details")
                    ->schema([

                        // TEXT INPUT
                        TextInput::make("name")
                            ->required()
                            ->maxLength(255),

                        // TEXT INPUT
                        FileUpload::make("thumbnail")
                            ->required()
                            ->image(),

                        // REPEATER PHOTOS
                        Repeater::make("photos")
                            // This should be the same to the MODEL!!
                            ->relationship("photos")
                            ->schema([
                                FileUpload::make("photo")
                                    ->required()
                            ]),

                        // REPEATER BONUS PACKAGE
                        Repeater::make("weddingBonusPackages")
                            ->relationship("weddingBonusPackages")
                            ->schema([
                                Select::make("bonus_package_id")
                                    ->label("Bonus Package")
                                    ->options(BonusPackage::all()->pluck("name", "id"))
                                    ->searchable()
                                    ->required()
                            ])
                    ])
                    ->columnSpanFull(),
                // ADDITIONALS
                Fieldset::make("Additional")
                    ->schema([
                        Textarea::make("about")
                            ->required(),

                        TextInput::make("price")
                            ->required()
                            ->numeric()
                            ->prefix("IDR"),

                        // SELECTING POPULAR
                        Select::make("is_popular")
                            ->options([
                                true => "Popular",
                                false => "Not Popular",
                            ])
                            ->required(),

                        // SELECTING CITY
                        Select::make("city_id")
                            ->relationship("city", "name")
                            ->searchable()
                            ->preload()
                            ->required(),

                        // SELECTING WEDDING ORGANIZER
                        Select::make("wedding_organizer_id")
                            ->relationship("weddingOrganizer", "name")
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])

                    // ColumnSpanFull must be added to fill the area of Fieldset
                    ->columnSpanFull(),
            ]);
    }
}
