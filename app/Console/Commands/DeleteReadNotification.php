<?php

namespace App\Console\Commands;

use App\Services\Contracts\INotificationService;
use Illuminate\Console\Command;

class DeleteReadNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all notifications marked as read';

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
        $countedRow = $this->notificationService->deleteAllReadNotifications();
        $this->output->text($countedRow . ' notifications deleted');
        return $countedRow;
    }
}
