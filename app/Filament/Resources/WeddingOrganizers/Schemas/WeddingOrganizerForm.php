<?php

namespace App\Filament\Resources\WeddingOrganizers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WeddingOrganizerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('phone'),
                FileUpload::make('icon'),
            ]);
    }
}
