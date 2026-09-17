<?php

namespace App\Filament\Resources\CtaSections;

use App\Filament\Resources\CtaSections\Pages\ManageCtaSections;
use App\Models\CtaSection;
use App\Services\CtaSectionService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class CtaSectionResource extends Resource
{
    use Translatable;
    protected static ?string $model = CtaSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCursorArrowRays;

    protected static ?string $recordTitleAttribute = 'small_title';

    public static function getPluralModelLabel(): string
    {
        return __('system.cta.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.cta.model');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->required()
                    ->image()
                    ->imageEditor()
                    ->disk('images')
                    ->directory('cta')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('small_title')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.small_title')),

                TextInput::make('big_title')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.big_title')),

                Repeater::make('items')
                    ->relationship()
                    ->simple(
                        TextInput::make('text')
                            ->required()
                            ->maxLength(255)
                            ->label(__('system.field.text')),
                    )
                    ->columnSpanFull()
                    ->label(__('system.field.items')),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('small_title')
            ->columns([
                ImageColumn::make('image')
                    ->disk('images')
                    ->imageHeight(100)
                    ->imageWidth(100)
                    ->label(__('system.field.image')),

                TextColumn::make('small_title')
                    ->searchable()
                    ->label(__('system.field.small_title')),

                TextColumn::make('big_title')
                    ->searchable()
                    ->label(__('system.field.big_title')),

                TextColumn::make('items_count')
                    ->counts('items')
                    ->label(__('system.field.items')),

                IconColumn::make('is_active')
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
                Action::make('activate')
                    ->label(__('system.action.activate'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(CtaSection $record): bool => ! $record->is_active)
                    ->authorize(fn(CtaSection $record): bool => auth()->user()->can('activate', $record))
                    ->requiresConfirmation()
                    ->action(fn(CtaSection $record, CtaSectionService $ctaService) => $ctaService->activate($record)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCtaSections::route('/'),
        ];
    }
}
