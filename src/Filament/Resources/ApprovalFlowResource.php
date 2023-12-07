<?php

namespace EightyNine\Approvals\Filament\Resources;

use EightyNine\Approvals\Filament\Resources\ApprovalFlowResource\Pages;
use EightyNine\Approvals\Filament\Resources\ApprovalFlowResource\RelationManagers;
use App\Models\ApprovalFlow;
use EightyNine\Approvals\Filament\Resources\ApprovalFlowResource\RelationManagers\StepsRelationManager;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RingleSoft\LaravelProcessApproval\Models\ProcessApprovalFlow;

class ApprovalFlowResource extends Resource
{
    protected static ?string $model = ProcessApprovalFlow::class;

    protected static ?string $modelLabel = 'Approval flow';

    protected static ?string $pluralModelLabel = 'Approval flows';
    
    protected static ?string $navigationGroup = "Configuration";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("name")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name"),
                TextColumn::make("approvable_type"),
            ])
            ->filters([
                //
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
            StepsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalFlows::route('/'),
            'create' => Pages\CreateApprovalFlow::route('/create'),
            'edit' => Pages\EditApprovalFlow::route('/{record}/edit'),
        ];
    }
}
