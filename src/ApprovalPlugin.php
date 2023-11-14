<?php

namespace EightyNine\Approvals;

use EightyNine\Approvals\Filament\Resources\ApprovalFlowResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class ApprovalPlugin implements Plugin
{

    protected bool $hasApprovalFlowResource = true;

    public function approvalFlowResource(bool $condition = true): static
    {
        $this->hasApprovalFlowResource = $condition;

        return $this;
    }

    public function hasApprovalFlowResource(): bool
    {
        return $this->hasApprovalFlowResource;
    }

    public function getId(): string
    {
        return 'filament-approvals';
    }

    public function register(Panel $panel): void
    {
        if ($this->hasApprovalFlowResource()) {
            $panel
                ->resources([
                    ApprovalFlowResource::class
                ]);
        }
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
