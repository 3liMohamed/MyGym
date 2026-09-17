<?php

namespace App\Filament\Resources\PricingPlans;

use App\Enums\PricingPeriod;
use App\Filament\Resources\PricingPlans\Pages\ManagePricingPlans;
use App\Models\PricingPlan;
use App\Services\PricingPlanService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class PricingPlanResource extends Resource
{
    use Translatable;
    protected static ?string $model = PricingPlan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getPluralModelLabel(): string
    {
        return __('system.pricing.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.pricing.model');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->disk('images')
                    ->directory('pricing')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(4)
                    ->label(__('system.field.title')),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix(__('system.currency.egp'))
                    ->columnSpan(4)
                    ->label(__('system.field.price')),

                Select::make('period')
                    ->required()
                    ->options(PricingPeriod::class)
                    ->native(false)
                    ->columnSpan(4)
                    ->label(__('system.field.period')),

                Repeater::make('features')
                    ->relationship()
                    ->simple(
                        TextInput::make('text')
                            ->required()
                            ->maxLength(255)
                            ->label(__('system.field.text')),
                    )
                    ->columnSpanFull()
                    ->label(__('system.field.features')),
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
                    ->label(__('system.field.title')),

                TextColumn::make('price')
                    ->money(__('system.currency.egp'))
                    ->sortable()
                    ->label(__('system.field.price')),

                TextColumn::make('period')
                    ->badge()
                    ->label(__('system.field.period')),

                TextColumn::make('features_count')
                    ->counts('features')
                    ->label(__('system.field.features')),

                ToggleColumn::make('is_active')
                    ->disabled(
                        fn(PricingPlan $record, PricingPlanService $pricingPlanService): bool =>
                        ! $record->is_active
                            && $pricingPlanService->activeCount(excluding: $record) >= $pricingPlanService->maxActive()
                    )
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
                Action::make('toggleActive')
                    ->icon(fn(PricingPlan $record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn(PricingPlan $record) => $record->is_active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function (PricingPlan $record, PricingPlanService $pricingPlanService) {
                        $success = $pricingPlanService->toggleActive($record, ! $record->is_active);
                        if (! $success) {
                            Notification::make()
                                ->danger()
                                ->title(__('system.pricing.max_active_title'))
                                ->body(__('system.pricing.max_active_body', ['max' => $pricingPlanService->maxActive()]))
                                ->send();
                        }
                    })
                    ->label(fn(PricingPlan $record) => $record->is_active ? __('system.action.deactivate') : __('system.action.activate'))
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePricingPlans::route('/'),
        ];
    }
}
