<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Services\Contracts\INotificationService;
use Illuminate\Console\Command;

class ClearNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all notification (set as read)';

    /**
     * @var INotificationService $notificationService
     */
    protected $notificationService;

    /**
     * Create a new command instance.
     * @param INotificationService $notificationService
     * @return void
     */
    public function __construct(INotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countUpdated = $this->notificationService->markAllNotificationsAsRead();
        $this->output->text($countUpdated . ' notifications marked as read');
        return $countUpdated;
    }
}
