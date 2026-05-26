<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use App\Notifications\AdminActionNotification;
use Illuminate\Http\Request;

class AdminActivityLogger
{
    public static function log(
        User $actor,
        string $module,
        string $action,
        string $message,
        ?string $entityType = null,
        ?int $entityId = null,
        ?array $payload = null,
        ?Request $request = null
    ): ActivityLog {
        $log = ActivityLog::create([
            'user_id' => $actor->id,
            'module' => $module,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'message' => $message,
            'payload' => $payload,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);

        $notificationData = [
            'module' => $module,
            'action' => $action,
            'message' => $message,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'log_id' => $log->id,
            'created_at' => now()->toDateTimeString(),
        ];

        User::role('Admin')
            ->where('id', '!=', $actor->id)
            ->get()
            ->each(fn (User $admin) => $admin->notify(new AdminActionNotification($notificationData)));

        return $log;
    }
}

