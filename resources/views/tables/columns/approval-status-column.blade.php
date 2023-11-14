<div>
    <p class="px-3">
        <small>
            {{ $getRecord()->approvalStatus->status }} by
            @if ($getRecord()->lastApproval)
                {{ $getRecord()->lastApproval->approver_name }}
            @else
                {{ $getRecord()->createdBy()->name }}
            @endif
        </small>
    </p>
    <p class="px-3 text-xs">
        <small>
            {{ $getRecord()->isApprovalCompleted() ? 'Completed' : 'In process' }}
        </small>
    </p>

</div>
