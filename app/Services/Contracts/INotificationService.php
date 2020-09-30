<?php


namespace App\Services\Contracts;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface INotificationService
 * @package App\Services\Contracts
 */
interface INotificationService
{
    /**
     * Get notification by user
     * @param User $user
     * @return array
     */
    function getNotificationsByUser(User $user);

    /**
     * Create an store a notification
     * @param $attributes
     * @param User $user
     * @return Notification
     */
    function storeNotification($attributes, User $user);

    /**
     * Mark all notifications as read, return the number of notification updated
     * @return int
     */
    function markAllNotificationsAsRead();

    /**
     * Delete all notifications with status read
     * @return mixed
     */
    function deleteAllReadNotifications();
}
