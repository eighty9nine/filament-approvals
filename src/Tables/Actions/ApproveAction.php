<?php

namespace EightyNine\Approvals\Tables\Actions;

use Closure;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ApproveAction extends Action
{

    public static function getDefaultName(): ?string
    {
        return 'Approve';
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary')
            ->action('Approve')
            ->visible(
                fn (Model $record) =>
                $record->canBeApprovedBy(Auth::user()) &&
                    $record->isSubmitted() &&
                    !$record->isApprovalCompleted() &&
                    !$record->isDiscarded()
            )
            ->requiresConfirmation();
    }


    public function action(Closure | string | null $action): static
    {
        if ($action !== 'Approve') {
            throw new \Exception('You\'re unable to override the action for this plugin');
        }

        $this->action = $this->approveModel();

        return $this;
    }


    /**
     * Approve data function.
     *
     */
    private function approveModel(): Closure
    {
        return function (array $data, Model $record): bool {
            $record->approve(comment: null, user: Auth::user());
            Notification::make()
                ->title('Approved successfully')
                ->success()
                ->send();
            return true;
        };
    }
}
