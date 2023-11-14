<?php

namespace EightyNine\Approvals\Models;

use EightyNine\Approvals\Traits\Approvable;
use Illuminate\Database\Eloquent\Model;
use RingleSoft\LaravelProcessApproval\Contracts\ApprovableModel as ContractsApprovableModel;

class ApprovableModel extends Model implements ContractsApprovableModel
{
    use Approvable;


}
