# Manage approval processes in your filament application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eightynine/filament-approvals.svg?style=flat-square)](https://packagist.org/packages/eightynine/filament-approvals)
[![Total Downloads](https://img.shields.io/packagist/dt/eightynine/filament-approvals.svg?style=flat-square)](https://packagist.org/packages/eightynine/filament-approvals)

This package allows you to implement approval flows in your Laravel Filament application.

_This package brings the ringlesoft/laravel-process-approval functionalities to filament. You can use all the ringlesoft/laravel-process-approval features in your laravel project. It also uses the spatie/laravel-permissions package, so you can use all its features._

## Quick understanding of the package

Some processes in your application require to be approved by multiple people before the process can be completed. For example, an employee submits a timesheet, then the supervisor approves, then manager approves and finally the HR approves and the timesheet is logged.
This package is a solution for this type of processes.

### Approval flow

This is the chain of events for a particular process. For example, timesheet submission, expense request, leave request. These processes require that multiple people have check and approve or reject, until the process is complete.

Approval flows are based on a model, example, ExpenseRequest, LeaveRequest, TimesheetLogSubmission etc

### Approval step

These are the steps that the process has. Each step is associated with a role that contains users that need to approve. When any of the users in the role approves, the process moves forward to the next step.

This package is based on roles, which are provided by the package spatie/laravel-permission.

## Installation

You can install the package via composer:

```bash
composer require eightynine/filament-approvals
```

## Usage

1. Run the migrations using:

```bash
php artisan migrate
```

2. Add the plugin to your panel service provider as follows:

```php

    ->plugins([
        \EightyNine\Approvals\ApprovalPlugin::make()
    ])
```

3. Make your model extend the ApprovableModel

```php
<?php

namespace App\Models;

use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends ApprovableModel
{
    use HasFactory;

    protected $fillable = ["name"];
}

```

4. In your resource, add the approvable actions:

```php
$table
    ->actions([
        ...\EightyNine\Approvals\Tables\Actions\ApprovalActions::make(
            // define your actions here that will appear once approval is completed
            Action::make("Done")
        ),
        Tables\Actions\EditAction::make(),
        Tables\Actions\ViewAction::make(),

    ])

```

5. In your view page, you can include the approval actions using the trait HasApprovalHeaderActions, and define the method getOnCompletionAction() that will return the action(s) to be shown once complete. If this method is not implemented and you use the trait, an error will be thrown.

```php
<?php

namespace App\Filament\Resources\LeaveRequestResource\Pages;

use App\Filament\Resources\LeaveRequestResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaveRequest extends ViewRecord
{
    use  \EightyNine\Approvals\Traits\HasApprovalHeaderActions;

    protected static string $resource = LeaveRequestResource::class;


    /**
     * Get the completion action.
     *
     * @return Filament\Actions\Action
     * @throws Exception
     */
    protected function getOnCompletionAction(): Action
    {
        return Action::make("Done")
            ->color("success")
            // Do not use the visible method, since it is being used internally to show this action if the approval flow has been completed.
            // Using the hidden method add your condition to prevent the action from being performed more than once
            ->hidden(fn(ApprovableModel $record)=> $record->shouldBeHidden())
    }
}

```

Just like that, you are good to go, make some moneyyyyy🤑

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Eighty Nine](https://github.com/eighty9nine)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
