<?php

namespace App\Filament\Resources\ChooseUs;

use App\Filament\Resources\ChooseUs\Pages\ManageChooseUs;
use App\Models\ChooseUs;
use App\Services\ChooseUsService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Illuminate\Support\Str;

class ChooseUsResource extends Resource
{
    use Translatable;

    protected static ?string $model = ChooseUs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getPluralModelLabel(): string
    {
        return __('system.choose.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.choose.model');
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
                    ->directory('choose')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label(__('system.field.title')),

                Textarea::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->label(__('system.field.description')),

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
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image')
                    ->disk('images')
                    ->imageSize(100)
                    ->label(__('system.field.image')),

                TextColumn::make('title')
                    ->searchable()
                    ->description(fn(ChooseUs $record): string => Str::limit($record->description ?? '', 50))
                    ->label(__('system.field.title')),

                TextColumn::make('items_count')
                    ->counts('items')
                    ->label(__('system.field.items')),
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
                    ->visible(fn(ChooseUs $record): bool => ! $record->is_active)
                    ->authorize(fn(ChooseUs $record): bool => auth()->user()->can('activate', $record))
                    ->requiresConfirmation()
                    ->action(fn(ChooseUs $record, ChooseUsService $chooseService) => $chooseService->activate($record)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageChooseUs::route('/'),
        ];
    }
}
