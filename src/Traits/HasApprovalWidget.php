<?php

namespace EightyNine\Approvals\Traits;

use EightyNine\Approvals\Widgets\ApprovalWidget;

trait HasApprovalWidget
{
    public function isReadOnly(): bool
    {
        return false;
    }
    protected function getHeaderWidgets(): array
    {
        $widgetPosition = $this->getApprovalWidgetPosition();
        if (!in_array($widgetPosition, ["top", "bottom"])) {
            $widgetPosition = "bottom";
        }
        return $widgetPosition == "top" ? [
            ApprovalWidget::class
        ] : [];
    }

    protected function getFooterWidgets(): array
    {
        $widgetPosition = $this->getApprovalWidgetPosition();
        if (!in_array($widgetPosition, ["top", "bottom"])) {
            $widgetPosition = "bottom";
        }
        return $widgetPosition == "bottom" ? [
            ApprovalWidget::class
        ] : [];
    }


    protected function getApprovalWidgetPosition()
    {
        return "bottom";
    }
}
