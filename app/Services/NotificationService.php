<?php


namespace App\Services;


use App\Models\Notification;
use App\Models\User;
use App\Services\Contracts\INotificationService;

class NotificationService implements INotificationService
{
    /**
     * @inheritdoc
     */
    public function getNotificationsByUser(User $user)
    {
        return $user->notifications()
                    ->orderByDesc('updated_at')
                    ->get()
                    ->all();
    }

    /**
     * @inheritdoc
     */
    public function storeNotification($attributes, User  $user)
    {
        $notification = new Notification($attributes);
        $notification->status = 'unread';
        $notification->user_id = $user->id;
        $notification->save();
        return $notification;
    }

    /**
     * @inheritdoc
     */
    public function markAllNotificationsAsRead()
    {
        return Notification::query()
            ->where('status', '<>','read')
            ->update(['status' => 'read']);
    }

    /**
     * @inheritdoc
     */
    public function deleteAllReadNotifications()
    {
        return Notification::query()
            ->where('status', 'read')
            ->delete();
    }
}
