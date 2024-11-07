<?php

namespace App\Policies;

use App\Models\PettyCashRequest;
use App\Models\User;

class PettyCashRequestPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function approve(User $user, PettyCashRequest $request)
    {
        // First level: Head of Department can approve pending requests
        if ($user->role === 'head_of_department' && $request->status === 'pending') {
            return true;
        }

        // Second level: Branch Manager can approve if HOD approved
        if ($user->role === 'branch_manager' && $request->status === 'approved_by_hod') {
            return true;
        }

        // Final level: General Manager can approve if Branch Manager approved
        if ($user->role === 'general_manager' && $request->status === 'approved_by_branch_manager') {
            return true;
        }

        return false;
    }

    public function reject(User $user, PettyCashRequest $request)
    {
        // Allow rejection at each approval stage
        if ($user->role === 'head_of_department' && $request->status === 'pending') {
            return true;
        }

        if ($user->role === 'branch_manager' && $request->status === 'approved_by_hod') {
            return true;
        }

        if ($user->role === 'general_manager' && $request->status === 'approved_by_branch_manager') {
            return true;
        }

        return false;
    }
}
