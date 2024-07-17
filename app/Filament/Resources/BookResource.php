<?php

namespace App\Filament\Resources;

use App\Enums\Category;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Filament\Resources\RelatedBookRelationManagerResource\RelationManagers\RelatedBooksRelationManager;
use App\Models\Book;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('isbn')
                    ->label('ISBN'),
                TextInput::make('title')
                    ->label('Title'),
                TextInput::make('author')
                    ->label('Author'),
                Select::make('category')
                    ->label('Category')
                    ->options(Category::class),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('isbn')
                    ->label('ISBN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Author')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\SelectColumn::make('category')
                    ->label('Category')
                    ->options(Category::class)
                    ->disabled(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options(Category::class)
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelatedBooksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
