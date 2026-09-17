<?php

namespace App\Filament\Resources\GymClasses;

use App\Enums\GymClassDay;
use App\Filament\Resources\GymClasses\Pages\ManageGymClasses;
use App\Models\GymClass;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class GymClassResource extends Resource
{
    use Translatable;
    protected static ?string $model = GymClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getPluralModelLabel(): string
    {
        return __('system.gym_class.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.gym_class.model');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day')
                    ->required()
                    ->options(GymClassDay::class)
                    ->native(false)
                    ->columnSpan(4)
                    ->label(__('system.field.day')),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.name')),

                TextInput::make('instructor')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.instructor')),

                TimePicker::make('start_time')
                    ->required()
                    ->seconds(false)
                    ->columnSpan(5)
                    ->label(__('system.field.start_time')),

                TimePicker::make('end_time')
                    ->required()
                    ->seconds(false)
                    ->after('start_time')
                    ->columnSpan(5)
                    ->label(__('system.field.end_time')),

                Toggle::make('is_active')
                    ->inline(false)
                    ->default(true)
                    ->columnSpan(2)
                    ->label(__('system.field.active')),

            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('day')
                    ->badge()
                    ->sortable()
                    ->label(__('system.field.day')),

                TextColumn::make('name')
                    ->searchable()
                    ->label(__('system.field.name')),

                TextColumn::make('time_range')
                    ->label(__('system.field.time')),

                TextColumn::make('instructor')
                    ->searchable()
                    ->label(__('system.field.instructor')),

                ToggleColumn::make('is_active')
                    ->label(__('system.field.active')),
            ])
            ->filters([
                SelectFilter::make('day')
                    ->options(GymClassDay::class)
                    ->label(__('system.field.day')),
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
            'index' => ManageGymClasses::route('/'),
        ];
    }
}
