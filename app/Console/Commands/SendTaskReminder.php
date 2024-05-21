<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Illuminate\Support\Facades\Log; // atau use Notifiable; untuk notifikasi email

class SendTaskReminder extends Command
{
    protected $signature = 'task:remind';
    protected $description = 'Send reminders for tasks due soon';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tasks = Task::where('status', '!=', 'completed')
            ->whereDate('due_date', '=', now()->addDays(1)->toDateString())
            ->get();

        foreach ($tasks as $task) {
            Log::info("Reminder: Task '{$task->title}' is due soon."); // Ganti dengan sistem notifikasi yang diinginkan
        }
    }
}
