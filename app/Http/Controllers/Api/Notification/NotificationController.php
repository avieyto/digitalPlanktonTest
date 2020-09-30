<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            return NotificationResource::collection(NotificationService::getNotificationByUser($user));
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }

    /**
     * @param NotificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        try {
            $input = $request->validated();

            /**
             * @var $user User
             */
            $user = $request->user();

            if (!$input)
                return response(['errors' => ['Incorrect request']], 400);

            $notification = NotificationService::storeNotification($input, $user);
            return new NotificationResource($notification);
        }
        catch(\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  NotificationRequest  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        try {
            /**
             * @var $user User
             */
            $user = $request->user();
            if ($notification->user_id != $user->id)
                throw new \Exception('Unauthorized access', 401);

            $notification->setAttribute('short_text', $request->short_text);
            $notification->setAttribute('long_text', $request->long_text);
            $notification->setAttribute('status', $request->status);
            $notification->save();

            return new NotificationResource($notification);
        }
        catch (\Throwable $exception) {
            $code = $exception->getCode() > 0 ? $exception->getCode() : 500;
            return response(['errors' => [$exception->getMessage()]], $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
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
