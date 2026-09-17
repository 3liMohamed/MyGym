<?php

namespace App\Filament\Resources\MarqueeItems;

use App\Filament\Resources\MarqueeItems\Pages\ManageMarqueeItems;
use App\Models\MarqueeItem;
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

class MarqueeItemResource extends Resource
{
    use Translatable;

    protected static ?string $model = MarqueeItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static ?string $recordTitleAttribute = 'text';

    public static function getPluralModelLabel(): string
    {
        return __('system.marquee.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.marquee.model');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('text')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(8)
                    ->label(__('system.field.text')),

                Toggle::make('is_highlighted')
                    ->columnSpan(2)
                    ->inline(false)
                    ->label(__('system.field.highlighted')),

                Toggle::make('is_active')
                    ->default(true)
                    ->inline(false)
                    ->columnSpan(2)
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

                IconColumn::make('is_highlighted')
                    ->boolean()
                    ->label(__('system.field.highlighted')),

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
            'index' => ManageMarqueeItems::route('/'),
        ];
    }
}
