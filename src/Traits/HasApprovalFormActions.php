<?php

namespace EightyNine\Approvals\Traits;

use EightyNine\Approvals\Forms\Actions\ApproveAction;
use EightyNine\Approvals\Forms\Actions\DiscardAction;
use EightyNine\Approvals\Forms\Actions\RejectAction;
use EightyNine\Approvals\Forms\Actions\SubmitAction;
use Filament\Actions\Action;

trait HasApprovalFormActions
{

    protected function getFormActions(): array
    {
        return [
            ...$this->formActions(),
            ...parent::getFormActions(),
        ];
    }

    protected function formActions(): array
    {
        return [
            ApproveAction::make(),
            RejectAction::make(),
            DiscardAction::make(),
            SubmitAction::make()
        ];
    }
}
