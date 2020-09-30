<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use App\Services\Contracts\INotificationService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @var INotificationService $notificationService
     */
    protected $notificationService;

    public function __construct(INotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            $notifications = $this->notificationService->getNotificationsByUser($user);
            return NotificationResource::collection($notifications);
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }

    /**
     * @param CreateNotificationRequest $request
     * @return NotificationResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateNotificationRequest $request)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();

            $notification = $this->notificationService->storeNotification($request, $user);
            return new NotificationResource($notification);
        }
        catch(\Throwable $exception) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return response(['errors' => [$exception->getMessage()]], $code);
        }
    }

    /**
     * @param Notification $notification
     * @param Request $request
     * @return NotificationResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Notification $notification, Request $request)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            if ($notification->user_id != $user->id)
                throw new \Exception('Unauthorized access', 401);

            return new NotificationResource($notification);
        }
        catch (\Throwable $exception) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return response(['errors' => [$exception->getMessage()]], $code);
        }
    }

    /**
     * @param UpdateNotificationRequest $request
     * @param Notification $notification
     * @return NotificationResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            if ($notification->user_id != $user->id)
                throw new \Exception('Unauthorized access', 401);

            $notification = $this->notificationService->updateNotification($request, $notification);
            return new NotificationResource($notification);
        }
        catch (\Throwable $exception) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return response(['errors' => [$exception->getMessage()]], $code);
        }
    }

    /**
     * @param Notification $notification
     * @param Request $request
     * @return NotificationResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Notification $notification, Request $request)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            if ($notification->user_id != $user->id)
                throw new \Exception('Unauthorized access', 401);

            $notification->delete();

            return new NotificationResource($notification);
        }
        catch (\Throwable $exception) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return response(['errors' => [$exception->getMessage()]], $code);
        }
    }
}
