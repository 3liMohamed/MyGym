<?php

namespace App\Filament\Resources\Abouts;

use App\Filament\Resources\Abouts\Pages\ManageAbouts;
use App\Models\About;
use App\Services\AboutService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
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
use Illuminate\Support\Str;

class AboutResource extends Resource
{
    use Translatable;

    protected static ?string $model = About::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getPluralModelLabel(): string
    {
        return __('system.about.navigation');
    }
    public static function getModelLabel(): string
    {
        return __('system.about.model');
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
                    ->directory('about')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('title')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.title')),

                TextInput::make('sub_title')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.sub_title')),

                Textarea::make('description')
                    ->columnSpanFull()
                    ->label(__('system.field.description')),

                Textarea::make('paragraph')
                    ->columnSpanFull()
                    ->label(__('system.field.paragraph')),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                ImageColumn::make('image')
                    ->disk('images')
                    ->imageHeight(100)
                    ->imageWidth(100)
                    ->label(__('system.field.image')),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label(__('system.field.title')),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label(__('system.field.is_active')),

                TextColumn::make('sub_title')
                    ->description(fn(About $record): string => Str::limit($record->description ?? '', 30))
                    ->searchable()
                    ->sortable()
                    ->label(__('system.field.sub_title')),

                TextColumn::make('paragraph')
                    ->limit(30)
                    ->label(__('system.field.paragraph')),
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
                    ->visible(fn(About $record): bool => ! $record->is_active)
                    ->authorize(fn (About $record): bool => auth()->user()->can('activate', $record))
                    ->requiresConfirmation()
                    ->action(fn (About $record, AboutService $aboutService) => $aboutService->activate($record)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAbouts::route('/'),
        ];
    }
}
