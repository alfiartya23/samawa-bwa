<?php

namespace App\Filament\Resources\BonusPackages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BonusPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name")
                    ->required()
                    ->maxLength(255),
                FileUpload::make('thumbnail')
                    ->required()
                    ->image(),
                TextArea::make("about")
                    ->required(),
                TextInput::make("price")
                    ->required()
                    ->numeric()
                    ->prefix("IDR"),
            ]);
    }
}
