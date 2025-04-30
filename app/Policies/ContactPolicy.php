<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Contact $contact): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Contact $contact): bool
    {
        return true;
    }

    public function delete(User $user, Contact $contact): bool
    {
        return true;
    }

    public function restore(User $user, Contact $contact): bool
    {
        return true;
    }

    public function forceDelete(User $user, Contact $contact): bool
    {
        return true;
    }
}
