<?php

namespace App\Filament\TeacherPanel\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Material;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\TeacherPanel\Resources\MaterialResource\Pages\EditMaterial;
use App\Filament\TeacherPanel\Resources\MaterialResource\Pages\ListMaterials;
use App\Filament\TeacherPanel\Resources\MaterialResource\Pages\CreateMaterial;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Learning Materials';
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return 'Learning Management';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('lesson_id')
                ->relationship('lesson', 'title')
                ->required(),
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),
            Forms\Components\Select::make('type')
                ->options([
                    'document' => 'Document',
                    'video' => 'Video Link',
                    'link' => 'External Link',
                ])
                ->required()
                ->reactive(),
            Forms\Components\FileUpload::make('file_path')
                ->label('Document')
                ->visible(fn(callable $get) => $get('type') === 'document')
                ->directory('materials'),
            Forms\Components\TextInput::make('video_url')
                ->label('Video URL')
                ->visible(fn(callable $get) => $get('type') === 'video')
                ->url(),
            Forms\Components\TextInput::make('external_url')
                ->label('External Link')
                ->visible(fn(callable $get) => $get('type') === 'link')
                ->url(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lesson.title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaterials::route('/'),
            'create' => CreateMaterial::route('/create'),
            'edit' => EditMaterial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();
        
        if ($user && $user->teacher) {
            return $query->whereHas('lesson.course', function (Builder $query) use ($user) {
                $query->where('teacher_id', $user->teacher->nip);
            });
        }
        
        return $query;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
