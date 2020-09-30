<?php


namespace App\Services;


use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
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
    public function storeNotification(CreateNotificationRequest $createNotificationRequest, User  $user)
    {
        $notification = new Notification($createNotificationRequest->all(['short_text', 'long_text']));
        $notification->status = 'unread';
        $notification->user_id = $user->id;
        $notification->save();
        return $notification;
    }

    /**
     * @inheritdoc
     */
    public function updateNotification(UpdateNotificationRequest $updateNotificationRequest, Notification $notification)
    {
        $short_text = $updateNotificationRequest->get('short_text', false);
        if ($short_text)
            $notification->short_text = $short_text;
        $long_text = $updateNotificationRequest->get('long_text', false);
        if ($long_text)
            $notification->long_text = $long_text;
        $notification->status = $status = $updateNotificationRequest->get('status', 'unread');
        $notification->updated_at = now();
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
