<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\ManagePosts;
use App\Models\Post;
use App\Services\PostService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getPluralModelLabel(): string
    {
        return __('system.post.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('system.post.model');
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
                    ->directory('posts')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label(__('system.field.image')),

                TextInput::make('category')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.category')),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(6)
                    ->label(__('system.field.title')),

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

                TextColumn::make('category')
                    ->badge()
                    ->label(__('system.field.category')),
            ])
            ->headerActions([
                LocaleSwitcher::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                Action::make('togglePublish')
                    ->icon(fn(Post $record) => $record->is_published ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn(Post $record) => $record->is_published ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function (Post $record, PostService $pricingPlanService) {
                        $success = $pricingPlanService->togglePublished($record, ! $record->is_published);
                        if (! $success) {
                            Notification::make()
                                ->danger()
                                ->title(__('system.post.max_publish_title'))
                                ->body(__('system.post.max_publish_body', ['max' => $pricingPlanService->maxPublished()]))
                                ->send();
                        }
                    })
                    ->label(fn(Post $record) => $record->is_published ? __('system.action.unpublished') : __('system.action.published'))
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePosts::route('/'),
        ];
    }
}
