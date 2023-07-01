<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    public function created(User $user): void
    {
        $payload = [
            'action' => 'created',
            'model'  => sprintf('%s#%s', get_class($user), $user->id),
            'reason' => auth()->user(),
        ];

        // role('admin')
        $admins = User::role('admin')->get();

        // Notification::send($admins, new DataChangeNotification($payload));
    }
}
