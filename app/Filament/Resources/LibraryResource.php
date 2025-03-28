<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Library;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\LibraryResource\Pages\EditLibrary;
use App\Filament\Resources\LibraryResource\Pages\CreateLibrary;
use App\Filament\Resources\LibraryResource\Pages\ListLibraries;

class LibraryResource extends Resource
{
    protected static ?string $model = Library::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Library Management';
    protected static ?string $modelLabel = 'Book';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('author')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('publisher')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('publication_year')
                ->required()
                ->numeric()
                ->minValue(1900)
                ->maxValue(date('Y')),
            Forms\Components\TextInput::make('isbn')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            Forms\Components\Select::make('category')
                ->required()
                ->options(Library::getCategories()),
            Forms\Components\TextInput::make('stock')
                ->required()
                ->numeric()
                ->minValue(0)
                ->default(0),
            Forms\Components\Textarea::make('description')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('cover_image')
                ->required()
                ->image()
                ->directory('books/covers'),
            Forms\Components\FileUpload::make('file_path')
                ->nullable()
                ->acceptedFileTypes(['application/pdf'])
                ->directory('books/files'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\TextColumn::make('author')
                ->searchable(),
            Tables\Columns\TextColumn::make('category')
                ->formatStateUsing(fn (string $state): string => Library::getCategories()[$state] ?? $state),
            Tables\Columns\TextColumn::make('stock')
                ->sortable(),
            Tables\Columns\IconColumn::make('file_path')
                ->boolean()
                ->trueIcon('heroicon-o-book-open')
                ->falseIcon('heroicon-o-book-closed')
                ->label('E-Book'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLibraries::route('/'),
            'create' => CreateLibrary::route('/create'),
            'edit' => EditLibrary::route('/{record}/edit'),
        ];
    }
}
