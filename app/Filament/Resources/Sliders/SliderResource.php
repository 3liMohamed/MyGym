<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages\ManageSliders;
use App\Models\Slider;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class SliderResource extends Resource
{
    use Translatable;
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getPluralModelLabel(): string
    {
        return __('system.slider.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.slider.model');
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
                    ->directory('sliders')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('title')
                    ->maxLength(255)
                    ->columnSpan(11)
                    ->label(__('system.field.title')),

                Toggle::make('is_active')
                    ->default(true)
                    ->columnSpan(1)
                    ->inline(false)
                    ->label(__('system.field.active')),

                TextInput::make('heading')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.heading')),

                TextInput::make('heading_highlight')
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.heading_highlight')),

                TextInput::make('button_label')
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.button_label')),

                TextInput::make('button_url')
                    ->url()
                    ->default('#')
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.button_url')),

                TextInput::make('video_url')
                    ->url()
                    ->default('#')
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.video_url')),


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
                    ->label(__('system.field.title')),

                TextColumn::make('heading')
                    ->limit(40)
                    ->label(__('system.field.heading')),

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
            'index' => ManageSliders::route('/'),
        ];
    }
}
