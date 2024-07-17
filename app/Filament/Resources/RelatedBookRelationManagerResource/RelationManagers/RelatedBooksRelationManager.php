<?php

namespace App\Filament\Resources\RelatedBookRelationManagerResource\RelationManagers;

use App\Enums\Category;
use App\Filament\Resources\BookResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class RelatedBooksRelationManager extends RelationManager
{
    protected static string $relationship = 'relatedBooks';

    protected static ?string $resource = BookResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ISBN')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(useModal: true)->preferModal(true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(useModal: true),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
