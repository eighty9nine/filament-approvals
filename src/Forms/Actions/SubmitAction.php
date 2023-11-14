<?php

namespace EightyNine\Approvals\Forms\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubmitAction extends Action
{

    public static function getDefaultName(): ?string
    {
        return 'Submit';
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->color('primary')
            ->action('Submit')
            ->visible(fn (Model $record) => !$record->isSubmitted() &&
            $record->approvalStatus->creator_id == Auth::id())
            ->requiresConfirmation();
    }


    public function action(Closure | string | null $action): static
    {
        if ($action !== 'Submit') {
            throw new \Exception('You\'re unable to override the action for this plugin');
        }

        $this->action = $this->submitModel();

        return $this;
    }


    /**
     * Submit data function.
     *
     */
    private function submitModel(): Closure
    {
        return function (array $data, Model $record): bool {
            $record->submit(Auth::user());
            Notification::make()
                ->title('Submitted successfully')
                ->success()
                ->send();
            return true;
        };
    }
}
