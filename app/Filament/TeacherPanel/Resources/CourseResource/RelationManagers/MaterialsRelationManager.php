<?php

namespace App\Filament\TeacherPanel\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'materials';
    protected static ?string $title = 'Materials';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('type')
                ->options([
                    'document' => 'Document',
                    'video' => 'Video',
                    'link' => 'External Link',
                ])
                ->required(),
            Forms\Components\FileUpload::make('file_path')
                ->label('Document')
                ->visible(fn (callable $get) => $get('type') === 'document')
                ->directory('lesson-materials'),
            Forms\Components\TextInput::make('video_url')
                ->label('Video URL')
                ->visible(fn (callable $get) => $get('type') === 'video'),
            Forms\Components\TextInput::make('external_url')
                ->label('External Link')
                ->visible(fn (callable $get) => $get('type') === 'link'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}