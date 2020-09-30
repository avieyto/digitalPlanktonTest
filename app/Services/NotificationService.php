<?php


namespace App\Services;


use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @return array
     */
    public static function getNotificationByUser(User $user)
    {
        return $user->notifications()
                    ->orderByDesc('updated_at')
                    ->get()
                    ->all();
    }

    /**
     * @param $attributes
     * @param User $user
     * @return Notification
     */
    public static function storeNotification($attributes, User  $user)
    {
        $notification = new Notification($attributes);
        $notification->status = 'unread';
        $notification->user_id = $user->id;
        $notification->save();
        return $notification;
    }
}
