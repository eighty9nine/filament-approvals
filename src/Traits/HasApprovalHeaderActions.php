<?php

namespace EightyNine\Approvals\Traits;


use EightyNine\Approvals\Forms\Actions\ApproveAction;
use EightyNine\Approvals\Forms\Actions\DiscardAction;
use EightyNine\Approvals\Forms\Actions\RejectAction;
use EightyNine\Approvals\Forms\Actions\SubmitAction;

trait HasApprovalHeaderActions
{

    protected function getHeaderActions(): array
    {
        return [
            ...$this->getApprovalHeaderActions()
        ];
    }

    protected function getApprovalHeaderActions(): array
    {
        return [
            ApproveAction::make(),
            RejectAction::make(),
            DiscardAction::make(),
            SubmitAction::make()
        ];
    }

}
