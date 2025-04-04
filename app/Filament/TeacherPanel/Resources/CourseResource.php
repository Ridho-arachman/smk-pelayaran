<?php

namespace App\Filament\TeacherPanel\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\TeacherPanel\Resources\CourseResource\RelationManagers\LessonsRelationManager;
use App\Filament\TeacherPanel\Resources\CourseResource\RelationManagers\MaterialsRelationManager;
use App\Filament\TeacherPanel\Resources\CourseResource\Pages;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'My Courses';

    protected static ?string $modelLabel = 'Course';
    protected static ?string $pluralModelLabel = 'Courses';
    public static function getNavigationGroup(): ?string
    {
        return 'Learning Management';
    }

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Course Information')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->directory('course-thumbnails')
                        ->columnSpanFull(),
                    // Add this hidden field to ensure teacher_id is set
                    Forms\Components\Hidden::make('teacher_id')
                        ->default(function () {
                            $user = Auth::user();
                            if ($user && $user->teacher) {
                                return $user->teacher->nip;
                            }
                            return null;
                        }),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publish course')
                        ->default(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Course $record): string => $record->description),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-course.png')),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Status')
                    ->trueColor('success')
                    ->falseColor('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_published')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ])
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),
                    Tables\Actions\Action::make('lessons')
                        ->label('Manage Lessons')
                        ->icon('heroicon-o-book-open')
                        ->url(fn(Course $record): string => route('filament.teacherPanel.resources.lessons.index', ['course' => $record->id]))
                        ->color('success'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ])
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            \Filament\Resources\RelationManagers\RelationGroup::make('Content', [
                LessonsRelationManager::class,
                MaterialsRelationManager::class,
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Only show courses created by the current teacher
        $user = Auth::user();

        if ($user && $user->teacher) {
            return parent::getEloquentQuery()->where('teacher_id', $user->teacher->nip);
        }

        return parent::getEloquentQuery();
    }
}
