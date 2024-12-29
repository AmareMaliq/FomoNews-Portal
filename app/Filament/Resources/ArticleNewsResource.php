<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ArticleNews;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleNewsResource\Pages;
use App\Filament\Resources\ArticleNewsResource\RelationManagers;

class ArticleNewsResource extends Resource
{
    protected static ?string $model = ArticleNews::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->live(debounce:1000),

                Forms\Components\TextInput::make('slug')
                ->disabled()
                ->required(),

                Forms\Components\Select::make('category_id')
                ->relationship('category','name')
                ->required()
                ->searchable()
                ->preload(),

                Forms\Components\Select::make('author_id')
                ->relationship('author','name')
                ->required()
                ->searchable()
                ->preload(),

                Forms\Components\Select::make('is_featured')
                ->options([
                    'featured' => 'Featured',
                    'not_featured' => 'Not Featured',
                ])
                ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->required(),

                Forms\Components\RichEditor::make('content')
                ->required()
                ->columnSpanFull()
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('is_featured')
                ->badge()
                ->color(fn(string $state): string => match($state) {
                    'featured' => 'success',
                    'not_featured' => 'danger'
                }),
                // Tables\Columns\TextColumn::make('category.name'),
                // Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\ImageColumn::make('thumbnail'),
              
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticleNews::route('/'),
            'create' => Pages\CreateArticleNews::route('/create'),
            'edit' => Pages\EditArticleNews::route('/{record}/edit'),
        ];
    }
}
