<?php

namespace EightyNine\Approvals\Tables\Actions;

use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Model;

class ApprovalActions
{
    public static function make(Action $action)
    {
        return [
            ActionGroup::make([
                SubmitAction::make(),
                ApproveAction::make(),
                DiscardAction::make(),
                RejectAction::make(),
            ])
                ->label('Approvals')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size(ActionSize::Small)
                ->color('primary')
                ->button(),
            $action
                ->visible(fn (Model $record) => $record->isApprovalCompleted()),
        ];
    }
}
