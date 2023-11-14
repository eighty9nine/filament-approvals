<?php

namespace EightyNine\Approvals\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EightyNine\Approval\Approval
 */
class Approval extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EightyNine\Approval\Approval::class;
    }
}
