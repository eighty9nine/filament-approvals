<?php

namespace EightyNine\Approvals\Filament\Resources\ApprovalFlowResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StepsRelationManager extends RelationManager
{
    protected static string $relationship = 'steps';

    public function form(Form $form): Form
    {
        $rolesModel = (string)config('process_approval.roles_model');
        return $form
            ->schema([
                Select::make("role_id")
                    ->label("Role")
                    ->helperText("Who should approve in this step?")
                    ->options(($rolesModel)::get()
                        ->map(fn ($model) => [
                            "name" => str($model->name)
                                ->replace("_", " ")
                                ->title()
                                ->toString(),
                            "id" => $model->id
                        ])->pluck("name", "id"))
                    ->native(false),
                Select::make("action")
                    ->helperText("What should be done in this step?")
                    ->native(false)
                    ->default("APPROVE")
                    ->options([
                        'APPROVE' => 'Approve',
                        'VERIFY' => 'Verify',
                        'CHECK' => 'Check'
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->reorderable("order")
            ->defaultSort('order', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('Order'),
                Tables\Columns\TextColumn::make('role.name'),
                Tables\Columns\TextColumn::make('action'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
