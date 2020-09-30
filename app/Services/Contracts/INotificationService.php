<?php


namespace App\Services\Contracts;

use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
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
     * Create and store a notification
     * @param CreateNotificationRequest $createNotificationRequest
     * @param User $user
     * @return Notification
     */
    function storeNotification(CreateNotificationRequest $createNotificationRequest, User $user);

    /**
     * Update a notification
     * @param UpdateNotificationRequest $updateNotificationRequest
     * @param Notification $notification
     * @return Notification
     */
    function updateNotification(UpdateNotificationRequest $updateNotificationRequest, Notification $notification);

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
