<?php

namespace EightyNine\Approvals\Widgets;

use EightyNine\Approvals\Forms\Actions\SubmitAction;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class ApprovalWidget extends Widget implements HasForms, HasActions
{
    use InteractsWithForms,  InteractsWithActions;

    public ?Model $record = null;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament-approvals::widgets.approval-widget';

    public function submitAction(): Action
    {
        return SubmitAction::make()
            ->record($this->record);
    }
}
