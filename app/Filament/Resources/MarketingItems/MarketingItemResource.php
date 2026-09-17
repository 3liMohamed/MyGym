<?php

namespace App\Filament\Resources\MarketingItems;

use App\Filament\Resources\MarketingItems\Pages\ManageMarketingItems;
use App\Models\MarketingItem;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class MarketingItemResource extends Resource
{
    use Translatable;

    protected static ?string $model = MarketingItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $recordTitleAttribute = 'text';

    public static function getPluralModelLabel(): string
    {
        return __('system.marketing.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.marketing.model');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('text')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(10)
                    ->label(__('system.field.text')),

                Toggle::make('is_highlight')
                    ->columnSpan(1)
                    ->inline(false)
                    ->label(__('system.field.is_highlight')),

                Toggle::make('is_active')
                    ->default(true)
                    ->inline(false)
                    ->columnSpan(1)
                    ->label(__('system.field.active')),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('text')
            ->columns([
                 TextColumn::make('text')
                    ->searchable()
                    ->label(__('system.field.text')),

                IconColumn::make('is_highlight')
                    ->boolean()
                    ->label(__('system.field.is_highlight')),

                ToggleColumn::make('is_active')
                    ->label(__('system.field.active')),
            ])
            ->headerActions([
                LocaleSwitcher::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMarketingItems::route('/'),
        ];
    }
}
