<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        return Auth::user()->id === $user->id;
    }

    public function update(User $user, Ticket $post)
    {
        // Authorization logic for updating an existing post
    }

    // Optionally, a global authorization rule using the `before` method
    public function before(User $user)
    {
        //
    }

}
