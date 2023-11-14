<?php

namespace EightyNine\Approvals\Tables\Actions;

use Closure;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RejectAction extends Action
{


    public static function getDefaultName(): ?string
    {
        return 'Reject';
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->color('danger')
            ->action('Reject')
            ->form($this->getDefaultForm())
            ->visible(
                fn (Model $record) =>
                $record->canBeApprovedBy(Auth::user()) &&
                    $record->isSubmitted() &&
                    !$record->isApprovalCompleted() &&
                    !$record->isDiscarded() &&
                    !$record->isRejected()
            )
            ->requiresConfirmation();
    }


    public function action(Closure | string | null $action): static
    {
        if ($action !== 'Reject') {
            throw new \Exception('You\'re unable to override the action for this plugin');
        }

        $this->action = $this->rejectModel();

        return $this;
    }


    /**
     * Discard data function.
     *
     */
    private function rejectModel(): Closure
    {
        return function (array $data, Model $record): bool {
            $record->reject($data["comment"], Auth::user());
            Notification::make()
                ->title('Rejected successfully')
                ->success()
                ->send();

            return true;
        };
    }


    protected function getDefaultForm(): array
    {
        return [
            Textarea::make("comment"),
        ];
    }
}
